<?php

namespace P;

class HTMLFormElement extends HTMLElement
{
    const ATTRIBUTES = ["name" => "string", "method" => "string", "target" => "string", "action" => "string", "acceptCharset" => "string", "autocomplete" => "string"] + parent::ATTRIBUTES;
    public function __construct($value = "", $uri = null)
    {
        parent::__construct("form", $value, $uri);
    }
}