<?php

namespace P;

class HTMLDivElement extends HTMLElement
{
    function __construct($value = "", $uri = "")
    {
        parent::__construct("div", $value, $uri);
    }
}
