<?php
namespace P;

class  HTMLInputElement extends HTMLElement
{
    const ATTRIBUTES = [
        "name" => "string",
        "required" => "bool",
        "checked" => "bool",
        "defaultChecked" => "bool",
        "indeterminate" => "bool",
        "type" => "string",
        "disabled" => "bool",
        "autofocus" => "bool",
        "value" => "string",
        "alt" => "string",
        "height" => "string",
        "src" => "string",
        "width" => "string",
        "accept" => "string",
        "autocomplete" => "string",
        "max" => "string",
        "maxLength" => ["type" => "string", "name" => "maxlength"],
        "min" => "string",
        "pattern" => "string",
        "placeholder" => "string",
        "readOnly" => ["type" => "bool", "name" => "readonly"],
        "size" => "int",
        "multiple" => "bool",
        "step" => "string"
    ] + parent::ATTRIBUTES;

    public function __construct($value = "", $uri = null)
    {
        parent::__construct("input", $value, $uri);
    }
}
