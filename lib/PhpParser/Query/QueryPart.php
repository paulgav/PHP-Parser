<?php

namespace PhpParser\Query;

class QueryPart {
    protected $nodeType;
    protected $attributes = [];
    protected $modifiers = [];

    static $typeShortcuts = [
        'method' => 'ClassMethod',
        'elseif' => 'ElseIf'
    ];
    public function __construct($query = '') {
        $this->parse($query);
    }
    public function getNodeType() {
        return $this->nodeType;
    }
    public function getAttributes() {
        return $this->attributes;
    }

    public function getModifier($key) {
        return isset($this->modifiers[$key]) ? $this->modifiers[$key] : null;
    }

    public function isItemIndexMached($itemIndex, $itemsCount) {
        $isAllowed = true;
        if ($this->getModifier('first')) {
            $isAllowed &= $itemIndex == 1;
        }

        if ($this->getModifier('last')) {
            $isAllowed &= $itemIndex == $itemsCount;
        }

        return $isAllowed;
    }

    protected function parse($query) {
        preg_match_all('/([a-zA-Z]*)(\[.+?\])?(\:[0-9a-zA-Z\-\(\)]+)?/', $query, $m);

        $this->nodeType = (isset(static::$typeShortcuts[$m[1][0]])) ? static::$typeShortcuts[$m[1][0]]: $m[1][0];
        if ($m[2]) {
            foreach ($m[2] as $a) {
                $a = ltrim($a, '[');
                $a = rtrim($a, ']');
                $a = trim($a);
                if ($a && preg_match('/([a-zA-Z]*)\=(.*)/', $a, $_m) && $_m[1] && $_m[2]) {
                    $_m[2] = ltrim($_m[2], '\'');
                    $_m[2] = ltrim($_m[2], '"');
                    $_m[2] = rtrim($_m[2], '\'');
                    $_m[2] = rtrim($_m[2], '"');
                    $this->attributes[$_m[1]] = $_m[2];
                }
            }
        }
        if ($m[3]) {
            foreach ($m[3] as $mod) {
                $mod = trim(ltrim($mod, ':'));
                if ($mod) {
                    $this->modifiers[$mod] = true;
                }
            }
        }

    }
}