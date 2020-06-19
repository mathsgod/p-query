<?php

namespace P;

class Proxy
{
    public $target;
    public $handler;

    public function __construct($target, $handler)
    {
        $this->target = $target;
        $this->handler = $handler;
    }

    public function __set($name, $value)
    {
        if (isset($this->handler["set"])) {
            $set = $this->handler["set"];
            $set->__invoke($this->target, $name, $value);
        }
    }

    public function __get($name)
    {
        if (isset($this->handler["get"])) {
            $get = $this->handler["get"];
            return $get->__invoke($this->target, $name);
        }
    }
}
