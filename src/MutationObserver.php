<?php

namespace P;

class MutationObserver
{
    private $callable;

    public function __construct(callable $callable)
    {
        $this->callable = $callable;
    }

    public function observe(Node $target, $options)
    { }

    public function discount()
    { }
}
