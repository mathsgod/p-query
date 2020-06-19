<?php
namespace P;

class HTMLSpanElement extends HTMLElement
{
    public function __construct(string $value = "", string $uri = null)
    {
        parent::__construct("span", $value, $uri);
    }
}
