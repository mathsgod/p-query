<?php

namespace P;

class DOMTokenList implements \ArrayAccess
{
    private $element;
    private $attribute_name;
    public function __construct(Element $element, $attribute_name)
    {
        $this->element = $element;
        $this->attribute_name = $attribute_name;
    }
    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $values = array_merge($this->values(), [$value]);
            $this->value = implode(" ", $values);
        } else {
            $values = $this->values();
            $values[$offset] = $value;
            $this->value = implode(" ", $values);
        }
    }
    public function offsetExists($offset)
    {
        return isset($this->values()[$offset]);
    }
    public function offsetUnset($offset)
    {
        $values = $this->values();
        unset($values[$offset]);
        $this->value = implode(" ", $values);
    }
    public function offsetGet($offset)
    {
        $values = $this->values();
        return isset($values[$offset]) ? $values[$offset] : null;
    }
    public function values()
    {
        $attribute = $this->element->getAttribute($this->attribute_name);
        if ($attribute) {
            return explode(" ", $attribute);
        } else {
            return [];
        }
    }
    public function __get($name)
    {
        if ($name == "length") {
            return count($this->values());
        }
        if ($name == "value") {
            return (string) $this->element->getAttribute($this->attribute_name);
        }
    }
    public function __set($name, $value)
    {
        if ($name == "value") {
            $this->element->setAttribute($this->attribute_name, $value);
        }
    }
    public function add(...$values)
    {
        foreach ($values as $value) {
            $this[] = $value;
        }
    }
    public function remove(...$values)
    {
        $values = array_diff($this->values(), $values);
        $this->value = implode(" ", $values);
    }
    public function contains($token)
    {
        return in_array($token, $this->values());
    }
    public function toggle($token)
    {
        if ($this->contains($token)) {
            $this->remove($token);
            return false;
        } else {
            $this->add($token);
            return true;
        }
    }
}