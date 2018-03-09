<?php
namespace P;

class HTMLInputElement extends HTMLElement
{
    public function __construct()
    {
        parent::__construct("input");
    }

    public function __set($name, $value)
    {
        switch ($name) {
            case "accept":
            case "alt":
            case "autocomplete":
            case "autofocus":
            case "defaultChecked":
            case "checked":
            case "dirName":
            case "disabled":
            case "formAction":
            case "formEnctype":
            case "formNoValidate":
            case "formTarget":
            case "height":
            case "indeterminate":
            case "max":
            case "maxLength":
            case "min":
            case "minLength":
            case "name":
            case "pattern":
            case "placeholder":
            case "readOnly":
            case "required":
            case "size":
            case "src":
            case "step":
            case "type":
            case "defaultValue":
            case "value":
            case "valueAsDate":
            case "valueAsNumber":
            case "width":
                $this->attributes[$name] = $value;

            default:
                parent::__set($name, $value);
        }
    }

    public function __get($name)
    {
        switch ($name) {
            case "accept":
            case "alt":
            case "autocomplete":
            case "autofocus":
            case "defaultChecked":
            case "checked":
            case "dirName":
            case "disabled":
            case "formAction":
            case "formEnctype":
            case "formNoValidate":
            case "formTarget":
            case "height":
            case "indeterminate":
            case "max":
            case "maxLength":
            case "min":
            case "minLength":
            case "name":
            case "pattern":
            case "placeholder":
            case "readOnly":
            case "required":
            case "size":
            case "src":
            case "step":
            case "type":
            case "defaultValue":
            case "value":
            case "valueAsDate":
            case "valueAsNumber":
            case "width":
                return $this->attributes[$name];
        }
        return parent::__get($name);
    }
}
