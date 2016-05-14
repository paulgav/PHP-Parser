<?php

namespace PhpParser;

use PhpParser\Query;

class Query {
    protected $parts = [];

    public function __construct($query = '') {
        if ($query) {
            $this->parse($query);
        }
    }
    public function getSubquery() {
        $instance = null;

        if (count($this->parts) > 1) {
            $instance = new self();
            $instance->setParts(array_slice($this->parts, 1));
        }

        return $instance;
    }

    public function getParts($index = null) {
        if (isset($index)) {
            return $this->parts[$index];
        } else {
            return $this->parts;
        }
    }

    protected function setParts($parts) {
        $this->parts = $parts;
    }
    protected function parse($query) {
        $tmp = explode(' ', $query);

        foreach ($tmp as $p) {
            $this->parts[] = new Query\QueryPart($p);
        }
    }
}