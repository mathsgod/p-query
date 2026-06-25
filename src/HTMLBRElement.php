<?php

namespace P;

class HTMLBRElement extends HTMLElement
{
    public function __construct(string|null $value = "", string|null $namespace = null)
    {
        parent::__construct("br", $value, $namespace);
    }
}
