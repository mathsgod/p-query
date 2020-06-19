<?php
namespace P;

class HTMLDivElement extends HTMLElement
{

    public function __construct($value = "", $uri = null)
    {
        parent::__construct("div", $value, $uri);
    }
}
