<?php

namespace P;

/**
 * @property string $name
 * @property string $method
 * @property string $target
 * @property string $action
 * @property string $acceptCharset
 * @property string $autocomplete
 * @property string $encoding
 * @property string $enctype
 * @property bool $noValidate
 */
class HTMLFormElement extends HTMLElement
{
    public function __construct($value = "", $uri = null)
    {
        parent::__construct("form", $value, $uri);
    }

    function __set($name, $value)
    {
        $attributes = [
            "name",
            "method",
            "target",
            "action",
            "autocomplete",
            "encoding",
            "enctype"
        ];

        if (in_array($name, $attributes)) {
            $this->setAttribute($name, $value);
        } elseif ($name === "acceptCharset") {
            $this->setAttribute("accept-charset", $value);
        } elseif ($name === "noValidate") {
            if ($value) {
                $this->setAttribute("novalidate", true);
            } else {
                $this->removeAttribute("novalidate");
            }
        } else {
            parent::__set($name, $value);
        }
    }

    function __get($name)
    {
        $attributes = [
            "name",
            "method",
            "target",
            "action",
            "autocomplete",
            "encoding",
            "enctype"
        ];

        if (in_array($name, $attributes)) {
            return $this->getAttribute($name);
        } elseif ($name === "acceptCharset") {
            return $this->getAttribute("accept-charset");
        } elseif ($name === "noValidate") {
            return $this->hasAttribute("novalidate");
        } else {
            return parent::__get($name);
        }
    }
}
