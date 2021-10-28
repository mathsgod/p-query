<?php

namespace P;

class HTMLDivElement extends HTMLElement
{
    function __construct($value = "", $uri = null)
    {
        parent::__construct("div", $value, $uri);
    }
}
