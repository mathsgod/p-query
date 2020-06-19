<?php

namespace P;

class HTMLButtonElement extends HTMLElement
{
    public function __construct($value = "", $uri = null)
    {
        parent::__construct("button", $value, $uri);
    }
}
