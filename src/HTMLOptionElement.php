<?php

namespace P;

/**
 * @property bool $defaultSelected
 * @property bool $disabled
 * @property bool $selected
 * @property string $text
 * @property string $value
 */
class HTMLOptionElement extends HTMLElement
{
    public function __construct(string|null $value = "", string|null $namespace = null)
    {
        parent::__construct("option", $value, $namespace);
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function __get($name)
    {
        switch ($name) {
            case "defaultSelected":
                return $this->hasAttribute("defaultSelected");
            case "disabled":
                return $this->hasAttribute("disabled");
            case "selected":
                return $this->hasAttribute("selected");
            case "text":
                return $this->textContent;
            case "value":
                if (!$this->hasAttribute("value")) {
                    return $this->getAttribute("text");
                }
                return $this->textContent;
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
            case "defaultSelected":
                if ($value) {
                    $this->setAttribute("defaultSelected", true);
                } else {
                    $this->removeAttribute("defaultSelected");
                }
                break;
            case "disabled":
                if ($value) {
                    $this->setAttribute("disabled", true);
                } else {
                    $this->removeAttribute("disabled");
                }
                break;
            case "selected":
                if ($value) {
                    $this->setAttribute("selected", true);
                } else {
                    $this->removeAttribute("selected");
                }
                break;
            case "text":
                $this->setAttribute("text", $value);
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
