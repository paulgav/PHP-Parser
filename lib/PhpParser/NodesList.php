<?php

namespace PhpParser;

class NodesList
{
    protected $nodes;

    /**
     * Creates a List of Nodes.
     *
     * @param array $attributes Array of attributes
     * @param array $openToken Open token
     * @param array $closeToken Close token
     */
  /*  public function __construct(array $nodes = array(), array $openToken = array(), array $closeToken = array()) {
        $this->nodes = $nodes;
        $this->openToken = $openToken;
        $this->closeToken = $closeToken;
    }*/
    public function __construct(array $nodes = array(),  $openToken = array(),  $closeToken = array()) {
        $this->nodes = $nodes;
        $this->openToken = $openToken;
        $this->closeToken = $closeToken;
    }
}
