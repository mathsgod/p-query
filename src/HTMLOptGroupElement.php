<?php

namespace P;

/**
 * @property bool $disabled Is a boolean value representing whether or not the whole list of children <option> is disabled (true) or not (false).
 * @property string $label
 * 
 */
class HTMLOptGroupElement extends HTMLElement
{
    public function __construct($value = "", $uri = null)
    {
        parent::__construct("optgroup", $value, $uri);
    }

    public function __get($name)
    {
        switch ($name) {
            case "disabled":
                $disabled = true;
                foreach ($this->getElementsByTagName("option") as $option) {
                    if (!$option->disabled) {
                        $disabled = false;
                        break;
                    }
                }
                return $disabled;
            case "label":
                return $this->getAttribute("label");
        }

        return parent::__get($name);
    }

    public function __set($name, $value)
    {
        switch ($name) {
            case "disabled":
                foreach ($this->getElementsByTagName("option") as $option) {
                    $option->disabled = $value;
                }
                break;
            case "label":
                $this->setAttribute("label", $value);
                break;
            default:
                parent::__set($name, $value);
        }
    }
}
