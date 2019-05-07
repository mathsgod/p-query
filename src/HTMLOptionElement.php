<?php
namespace P;

class HTMLOptionElement extends HTMLElement
{
    const ATTRIBUTES = [
        "defaultSelected" => "bool",
        "disabled" => "bool",
        "label" => "string",
        "selected" => "bool",
        "value" => "string"
    ] + parent::ATTRIBUTES;

    public function __construct($value = "", $uri = null)
    {
        parent::__construct("option", $value, $uri);
    }
}
