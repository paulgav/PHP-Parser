<?php

namespace PhpParser\Node\Expr;

use PhpParser\Node\Expr;
use PhpParser\NodesList;

class Array_ extends Expr
{
    // For use in "kind" attribute
    const KIND_LONG = 1;  // array() syntax
    const KIND_SHORT = 2; // [] syntax

    /** @var NodesList\ArrayItems */
    public $items;

    /**
     * Constructs an array node.
     *
     * @param NodesList\ArrayItems $items  Items of the array
     * @param array       $attributes Additional attributes
     */
    public function __construct(NodesList\ArrayItems $items = null, array $attributes = array()) {
        parent::__construct($attributes);
        $this->items = $items;
    }

    public function getSubNodeNames() {
        return array('items');
    }
}
