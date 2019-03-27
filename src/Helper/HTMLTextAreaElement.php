<?php

namespace P\Helper;

class HTMLTextAreaElement extends Element
{
    public function __set($name, $value)
    {
        switch ($name) {
            case "autocomplete":
            case "autofocus":
            case "cols":
            case "dirName":
            case "disabled":
            case "maxLength":
            case "minLength":
            case "name":
            case "placeholder":
            case "readOnly":
            case "required":
            case "rows":
            case "wrap":
            case "type":
            case "defaultValue":
            case "value":
                $this->element->setAttribute($name, $value);
                break;
            default:
                parent::__set($name, $value);
        }
    }

    public function __get($name)
    {
        switch ($name) {
            case "autocomplete":
            case "autofocus":
            case "cols":
            case "dirName":
            case "disabled":
            case "maxLength":
            case "minLength":
            case "name":
            case "placeholder":
            case "readOnly":
            case "required":
            case "rows":
            case "wrap":
            case "type":
                return $this->element->getAttribute($name);
                break;
            case "textLength":
                return strlen($this->element->nodeValue);
            case "value":
                return $this->element->nodeValue;
            default:
                return parent::__get($name);
        }
    }
}
