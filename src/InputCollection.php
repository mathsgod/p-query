<?php

namespace P;

class InputCollection extends Query
{
    public function required($value = true)
    {
        foreach ($this as $node) {
            $node->setAttribute("required", $value);
        }
        $this->trigger("change");
        return $this;
    }
    public function minlength($value)
    {
        foreach ($this as $node) {
            $node->setAttribute("minlength", $value);
        }
        $this->trigger("change");
        return $this;
    }
    public function type($value)
    {
        foreach ($this as $node) {
            $node->setAttribute("type", $value);
        }
        $this->trigger("change");
        return $this;
    }
    public function min($value)
    {
        foreach ($this as $node) {
            $node->setAttribute("min", $value);
        }
        $this->trigger("change");
        return $this;
    }
    public function max($value)
    {
        foreach ($this as $node) {
            $node->setAttribute("max", $value);
        }
        $this->trigger("change");
        return $this;
    }
    public function name($value)
    {
        foreach ($this as $node) {
            $node->attributes("name", $value);
        }
        $this->trigger("change");
        return $this;
    }
}