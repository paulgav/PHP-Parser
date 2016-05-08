<?php

namespace PhpParser;

abstract class TagAbstract
{
    protected $attributes;
    protected $value;

    /**
     * Creates a Node.
     *
     * @param array $attributes Array of attributes
     */
    public function __construct($value, array $attributes = array()) {

        $this->attributes = $attributes;
        $this->value = $value;
    }

    /**
     * Gets line the node started in.
     *
     * @return int Line
     */
    public function getLine() {
        return $this->getAttribute('startLine', -1);
    }

    /**
     * Sets line the node started in.
     *
     * @param int $line Line
     */
    public function setLine($line) {
        $this->setAttribute('startLine', (int) $line);
    }

    public function setAttribute($key, $value) {
        $this->attributes[$key] = $value;
    }

    public function hasAttribute($key) {
        return array_key_exists($key, $this->attributes);
    }

    public function &getAttribute($key, $default = null) {
        if (!array_key_exists($key, $this->attributes)) {
            return $default;
        } else {
            return $this->attributes[$key];
        }
    }

    public function getAttributes() {
        return $this->attributes;
    }
}