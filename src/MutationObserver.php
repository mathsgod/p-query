<?php

namespace P;

class MutationObserver
{
    public $callable;

    function __construct(callable $callable)
    {
        $this->callable = $callable;
    }

    function observe(Element $target, $options)
    {
        $target->registerMutationObserver($this, $options);
    }

    function disconnect()
    {
    }

    function takeRecords()
    {
    }
}
