<?php

namespace P;

class HTMLParagraphElement  extends HTMLElement
{
    public function __construct(string $value = "", ?string $uri = "")
    {
        parent::__construct("p", $value, $uri);
    }
}
