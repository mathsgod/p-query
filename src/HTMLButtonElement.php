<?php

namespace P;

/**
 * @property bool $disabled
 * @property string $name
 * @property string $value
 */

class HTMLButtonElement extends HTMLElement
{
    public function __construct($value = "", $uri = null)
    {
        parent::__construct("button", $value, $uri);
    }

    function __set($name, $value)
    {
        switch ($name) {
            case "disabled":
                $this->setAttribute("disabled", $value);
                return;
            case "name":
                $this->setAttribute("name", $value);
                return;
            case "value":
                $this->setAttribute("value", $value);
                return;
        }
        parent::__set($name, $value);
    }

    function __get($name)
    {
        switch ($name) {
            case "disabled":
                return $this->getAttribute("disabled");
            case "name":
                return $this->getAttribute("name");
            case "value":
                return $this->getAttribute("value");
        }
        return parent::__get($name);
    }
}
