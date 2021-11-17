<?php

namespace P;

class HTMLTableCaptionElement extends HTMLElement
{
    public function __construct($value = "", $uri = null)
    {
        parent::__construct("caption", $value, $uri);
    }
}
