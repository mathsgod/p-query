<?php

namespace P;

class HTMLSpanElement extends HTMLElement
{
    public function __construct(string|null $value = "", string|null $namespace = null)
    {
        parent::__construct("span", $value, $namespace);
    }
}
