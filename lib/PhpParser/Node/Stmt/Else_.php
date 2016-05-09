<?php

namespace PhpParser\Node\Stmt;

use PhpParser\Node;
use PhpParser\NodesList;

class Else_ extends Node\Stmt
{
    /** @var Node[] Statements */
    public $stmts;

    /**
     * Constructs an else node.
     *
     * @param Node[] $stmts      Statements
     * @param array  $attributes Additional attributes
     */
    public function __construct(NodesList\Stmts $stmts = null, array $attributes = array()) {
        parent::__construct($attributes);

        $this->stmts = $stmts;
    }

    public function getSubNodeNames() {
        return array('stmts');
    }
}
