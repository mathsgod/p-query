<?php

namespace P;

class HTMLParagraphElement extends HTMLElement
{
    public function __construct(string|null $value = "", string|null $namespace = null)
    {
        parent::__construct("p", $value, $namespace);
    }
}
