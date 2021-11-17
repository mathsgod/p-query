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
class  HTMLFormElement extends HTMLElement
{
    public function __construct($value = "", $uri = null)
    {
        parent::__construct("form", $value, $uri);
    }

    function __set($name, $value)
    {
        switch ($name) {
            case "name":
                $this->setAttribute("name", $value);
                break;
            case "method":
                $this->setAttribute("method", $value);
                break;
            case "target":
                $this->setAttribute("target", $value);
                break;
            case "action":
                $this->setAttribute("action", $value);
                break;
            case "acceptCharset":
                $this->setAttribute("accept-charset", $value);
                break;
            case "autocomplete":
                $this->setAttribute("autocomplete", $value);
                break;
            case "encoding":
                $this->setAttribute("enctype", $value);
                break;
            case "enctype":
                $this->setAttribute("enctype", $value);
                break;
            case "noValidate":
                if ($value) {
                    $this->setAttribute("novalidate", true);
                } else {
                    $this->removeAttribute("novalidate");
                }
                break;
            default:
                parent::__set($name, $value);
        }
        parent::__set($name, $value);
    }

    function __get($name)
    {
        switch ($name) {
            case "name":
                return $this->getAttribute("name");
            case "method":
                return $this->getAttribute("method");
            case "target":
                return $this->getAttribute("target");
            case "action":
                return $this->getAttribute("action");
            case "acceptCharset":
                return $this->getAttribute("accept-charset");
            case "autocomplete":
                return $this->getAttribute("autocomplete");
            case "encoding":
                return $this->getAttribute("enctype");
            case "enctype":
                return $this->getAttribute("enctype");
            case "noValidate":
                return $this->hasAttribute("novalidate");
            default:
                return parent::__get($name);
        }
        return parent::__get($name);
    }
}
