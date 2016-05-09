<?php

namespace PhpParser;

use PhpParser\Tag;

class NodesListAbstract
{
    protected $nodes;

    /**
     * Creates a List of Nodes.
     *
     * @param array $attributes Array of attributes
     * @param array $openTag Open tag
     * @param array $closeTag Close tag
     */
    public function __construct(array $nodes = array(), Tag\ListOpen $openTag = null, Tag\ListClose $closeTag = null) {
        $this->nodes = $nodes;
        $this->openTag = $openTag;
        $this->closeTag = $closeTag;
    }
}
