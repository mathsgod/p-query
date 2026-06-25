<?php

namespace P;

class HTMLTableCaptionElement extends HTMLElement
{
    public function __construct(string|null $value = "", string|null $namespace = null)
    {
        parent::__construct("caption", $value, $namespace);
    }
}
