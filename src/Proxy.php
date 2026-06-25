<?php

namespace P;

class Proxy
{
    public object $target;

    /** @var array<string, callable> */
    public array $handler;

    public function __construct(object $target, array $handler)
    {
        $this->target = $target;
        $this->handler = $handler;
    }

    /**
     * @param string $name
     * @param mixed $value
     */
    public function __set($name, $value): void
    {
        if (isset($this->handler["set"])) {
            $set = $this->handler["set"];
            $set->__invoke($this->target, $name, $value);
        }
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function __get($name)
    {
        if (isset($this->handler["get"])) {
            $get = $this->handler["get"];
            return $get->__invoke($this->target, $name);
        }
        return null;
    }
}
