<?php

namespace P;

/**
 * @property string $name
 * @property string $type
 * @property bool $disabled
 * @property bool $autofocus
 * @property bool $required 
 * @property string $value
 * @property-read ?HTMLFormElement $form
 */
class  HTMLInputElement extends HTMLElement
{
    const ATTRIBUTES = [
        "checked" => "bool",
        "defaultChecked" => "bool",
        "indeterminate" => "bool",
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

    function __get($name)
    {
        if ($name == "form") {
            return $this->closest("form");
        }

        switch ($name) {
            case "name":
                return $this->getAttribute("name");
            case "type":
                return $this->getAttribute("type");
            case "disabled":
                return $this->hasAttribute("disabled");
            case "autofocus":
                return $this->hasAttribute("autofocus");
            case "required":
                return $this->hasAttribute("required");
            case "value":
                return $this->getAttribute("value");
            default:
                return parent::__get($name);
        }
    }

    function __set($name, $value)
    {
        switch ($name) {
            case "name":
                $this->setAttribute("name", $value);
                break;
            case "type":
                $this->setAttribute("type", $value);
                break;
            case "disabled":
                if ($value) {
                    $this->setAttribute("disabled", true);
                } else {
                    $this->removeAttribute("disabled");
                }
                break;
            case "autofocus":
                if ($value) {
                    $this->setAttribute("autofocus", true);
                } else {
                    $this->removeAttribute("autofocus");
                }
                break;
            case "required":
                if ($value) {
                    $this->setAttribute("required", true);
                } else {
                    $this->removeAttribute("required");
                }
                break;
            case "value":
                $this->setAttribute("value", $value);
                break;
            default:
                parent::__set($name, $value);
                break;
        }
    }
}
