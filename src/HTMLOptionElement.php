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

    public function __construct($text = null, $value = null, $defaultSelected = false)
    {
        parent::__construct("option");
        /*if ($value) {
            $this->attributes["value"] = $value;
        }

        $this->attributes["selected"] = $defaultSelected;
        if ($text) {
            $this->appendChild(new Text($text));
        }*/
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
