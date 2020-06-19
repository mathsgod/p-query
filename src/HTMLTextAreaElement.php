<?php
namespace P;

class HTMLTextAreaElement extends HTMLElement
{
    const ATTRIBUTES = [
        "autocomplete" => "string",
        "autofocus" => "string",
        "placeholder" => "string",
        "rows" => "int",
        "cols" => "int",
        "autofocus" => "bool",
        "name" => "string",
        "disabled" => "bool",
        "readOnly" => ["type" => "bool", "name" => "readonly"],
        "required" => "bool",
        "tabIndex" => "int",
        "dirName" => "string",
        "maxLength" => ["type" => "string", "name" => "maxlength"],
        "minLength" => ["type" => "string", "name" => "minlength"],
        "autocapitalize" => "string",
        "wrap" => "string"
    ] + parent::ATTRIBUTES;
    
    public function __construct($value = "", $uri = null)
    {
        parent::__construct("textarea", $value, $uri);
    }

    public function __get($name)
    {
        switch ($name) {
            case "textLength":
                return strlen($this->nodeValue);
            case "value":
                return $this->nodeValue;
            default:
                return parent::__get($name);
        }
    }
}
