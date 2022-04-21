<?php

namespace P;

class HTMLBRElement extends HTMLElement
{
    public function __construct(string|null $value = null, string $namespace = null)
    {
        parent::__construct("br", $value, $namespace);
    }
}
