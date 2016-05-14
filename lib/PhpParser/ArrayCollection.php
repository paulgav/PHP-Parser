<?php

namespace PhpParser;

class ArrayCollection implements \IteratorAggregate, \ArrayAccess, \Countable {

    protected $__collection = [];

    public function __construct(array &$array = []) {
        $this->__collection = &$array;
    }

    public function append($object, $itemAfter = null) {
        $index = false;

        if ($itemAfter) {
            $index = array_search($itemAfter, $this->__collection);
        }

        $index = ($index !== false) ? $index + 1 : count($this->__collection);

        array_splice($this->__collection, $index, 0, array($object));

        return $index;
    }

    public function prepend($object, $itemBefore = null) {
        $index = false;

        if ($itemBefore) {
            $index = array_search($itemBefore, $this->__collection);
        }

        $index = ($index !== false) ? $index : 0;

        array_splice($this->__collection, $index, 0, array($object));

        return $index;
    }

    public function remove() {
        $args = func_get_args();
        foreach ($args as $object) {
            unset($this->__collection[array_search($object, $this->__collection)]);
        }
        return $this;
    }

    public function clear() {
        $this->__collection = array();

        return $this;
    }

/*    public static function merge() {
        $args = func_get_args();

        foreach ($args as $k => $v) {
            $this->__collection = array_merge($this->__collection, $v);
        }

        return $index;
    }
*/
    public function isEmpty() {
        return empty($this->__collection);
    }

    public function getIterator() {
        return new Iterator($this->__collection);
    }

    public function offsetSet($offset, $object) {
        if ($offset === NULL) {
            if (count($this->__collection) > 0) {
                $offset = max(array_keys($this->__collection));
            } else {
                $offset = 0;
            }
        }
        $this->__collection[$offset] = $object;
    }

    public function offsetExists($offset) {
        return isset($this->__collection[$offset]);
    }

    public function offsetUnset($offset) {
        unset($this->__collection[$offset]);
    }

    public function offsetGet($offset) {
        if (isset($this->__collection[$offset]) === FALSE) {
            return NULL;
        }
        return $this->__collection[$offset];
    }

    public function count() {
        return sizeof($this->__collection);
    }

}
?>