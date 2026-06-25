<?php

namespace P;

class HTMLDivElement extends HTMLElement
{
    public function __construct(string|null $value = "", string|null $namespace = null)
    {
        parent::__construct("div", $value, $namespace);
    }
}
