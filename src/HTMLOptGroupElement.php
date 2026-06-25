<?php

namespace P;

/**
 * @property bool $disabled Is a boolean value representing whether or not the whole list of children <option> is disabled (true) or not (false).
 * @property string $label
 */
class HTMLOptGroupElement extends HTMLElement
{
    public function __construct(string|null $value = "", string|null $namespace = null)
    {
        parent::__construct("optgroup", $value, $namespace);
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function __get($name)
    {
        switch ($name) {
            case "disabled":
                foreach ($this->getElementsByTagName("option") as $option) {
                    if (!$option->disabled) {
                        return false;
                    }
                }
                return true;
            case "label":
                return $this->getAttribute("label");
        }

        return parent::__get($name);
    }

    /**
     * @param string $name
     * @param mixed $value
     * @return void
     */
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
