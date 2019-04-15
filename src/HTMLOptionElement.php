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

    public function __set($name, $value)
    {

        switch ($name) {
            case "selected":
                $this->setAttribute($name, $value);
                return;
        }
        parent::__set($name, $value);
    }
}
