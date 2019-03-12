<?php

namespace P;

class HTMLTextAreaElement extends HTMLElement
{
    public $value;
    public $rows;
    public $cols;

    public function __construct()
    {
        parent::__construct("textarea");
    }
    public function __toString()
    {
        if ($this->rows) $this->attributes["rows"] = $this->rows;
        if ($this->cols) $this->attributes["cols"] = $this->cols;
        $this->childNodes = array();
        $this->appendChild(new Text($this->value));
        return parent::__toString();
    }

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
                $this->attributes[$name] = $value;
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
                return $this->attributes[$name];
                break;
            case "textLength":
                return strlen($this->value);
            default:
                return parent::__get($name);
        }
    }
}

