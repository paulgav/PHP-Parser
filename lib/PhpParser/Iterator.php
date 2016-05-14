<?php
namespace PhpParser;

class Iterator implements \Iterator {
    private $position = 0;
    private $array = array();

    public function __construct($array) {
        $this->array = $array;
        $this->position = 0;
    }

    function rewind() {
        $this->position = 0;
    }

    function current() {
        return $this->array[$this->position];
    }

    function key() {
        return $this->position;
    }

    function next() {
        ++$this->position;
    }

    function valid() {
        return isset($this->array[$this->position]);
    }
}
?>