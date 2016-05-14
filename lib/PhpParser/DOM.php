<?php

namespace PhpParser;

class DOM {
    protected $lexer;

    protected $parser;

    protected $stmts;

    protected $sourceCode = '';

   // protected $fileModifier;

    public function __construct() {

        $this->lexer = new Lexer(array(
            'usedAttributes' => array(
                'comments', 'startLine', 'endLine', 'startTokenPos', 'endTokenPos','startFilePos','endFilePos'
            )
        ));

        $this->parser = new Parser\Php5($this->lexer);

        //$this->parser = (new ParserFactory)->create(ParserFactory::PREFER_PHP5, $this->lexer);

    }
    public function loadFile($filename) {
       // $this->fileModifier = new \AwSDK\FileModifier($filename);
        $code = file_get_contents($filename);
        $this->sourceCode = $code;

        $this->stmts = $this->parser->parse($code);

    }

    public function prettyPrint() {
        $prettyPrinter = new PrettyPrinter\Standard();
        //var_dump($this->stmts);die;
        var_dump($this->stmts);
        return $prettyPrinter->prettyPrintFile($this->stmts);
    }

    public function find($query) {
        $query = new Query($query);

        $nodes = $this->traverseArray($this->stmts, $query);
        $_nodes = [];
        foreach ($nodes as $node) {
            $_nodes[] = $node;
        }
        return $_nodes;
    }

    public function findOne($query) {
        $nodes = $this->find($query);

        return $nodes ? $nodes[0] : false;
    }

    protected function getNodeTypeByKeyword($kw) {
        return 'Stmt' . '_' . ucfirst($kw);
    }

    protected function compare(Node $node, Query\QueryPart $part) {
        if ($node->getType() == $this->getNodeTypeByKeyword($part->getNodeType())) {
            $attributesMatch = true;
            foreach ($part->getAttributes() as $k => $v) {
                if (property_exists($node, $k) && $node->$k != $v) {
                    $attributesMatch = false;
                }
            }
            return $attributesMatch;
        } else {
            return false;
        }
    }
    protected function traverseNode(Node $node, Query $query) {
        $_query = $query;
        $isMatched = false;

        if ($this->compare($node, $query->getParts(0))) {
           $subquery = $query->getSubquery();
           $_query = $subquery;
           if (!$subquery) {
               return array($node);
           }
           $isMatched = true;
        }
        //var_dump($node->getType(),$query,$query->getParts(0),$isMatched);
        $nodes = [];
        foreach ($node->getSubNodeNames() as $name) {
            $subNode =& $node->$name;
            if ($subNode instanceof NodesListAbstract) {
                $nodes = array_merge($nodes, $this->traverseArray($subNode, $_query));
            } elseif ($subNode instanceof Node) {
                $traverseChildren = true;

                if ($traverseChildren) {
                    $nodes = array_merge($nodes, $this->traverseNode($subNode, $_query));
                }
            }
        }
        return $nodes;
    }

    protected function traverseArray($_nodes, Query $query) {
        $nodes = [];
        $counter = 0;
        foreach ($_nodes as $i => $node) {
            $counter++;
            if ($node instanceof NodesListAbstract) {

                $nodes = array_merge($nodes, $this->traverseArray($node, $query));
            } elseif ($node instanceof Node) {

                if ($query->getParts(0)->isItemIndexMached($counter, count($_nodes))) {
                    $nodes = array_merge($nodes, $this->traverseNode($node, $query));
                }

            }
        }

        return $nodes;
    }
}
