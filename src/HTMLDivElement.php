<?php

namespace P;

class HTMLDivElement extends HTMLElement
{
    public function __construct(string|null $value = null, string $namespace = null)
    {
        parent::__construct("div", $value, $namespace);
    }
}
