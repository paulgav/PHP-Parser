<?php

namespace PhpParser;

use PhpParser\Tag;

abstract class NodesListAbstract extends ArrayCollection
{

    /**
     * Creates a List of Nodes.
     *
     * @param array $attributes Array of attributes
     * @param array $openTag Open tag
     * @param array $closeTag Close tag
     */
    public function __construct(array $nodes = array(), Tag\ListOpen $openTag = null, Tag\ListClose $closeTag = null) {
        $this->openTag = $openTag;
        $this->closeTag = $closeTag;

        parent::__construct($nodes);
    }
}
