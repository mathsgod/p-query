<?php

namespace P;

/**
 * @property bool $autofocus Is a boolean value indicating whether or not the control should have input focus when the page loads, unless the user overrides it, for example by typing in a different control. Only one form-associated element in a document can have this attribute specified.
 * @property bool $disabled Is a boolean value indicating whether or not the control is disabled, meaning that it does not accept any clicks.
 * @property string $name Is a DOMString representing the name of the object when submitted with a form. If specified, it must not be the empty string.
 * @property string $type Is a DOMString representing the type of button. Possible values are: submit , reset , button , and menu .
 * @property string $value Is a DOMString representing the current form control value of the button.
 */

class HTMLButtonElement extends HTMLElement
{
    public function __construct(string|null $value = null, string $namespace = null)
    {
        parent::__construct("button", $value, $namespace);
    }

    public function __get($name)
    {
        if ($name == "autofocus") {
            return $this->hasAttribute("autofocus");
        }
        if ($name == "disabled") {
            return $this->hasAttribute("disabled");
        }
        if ($name == "name") {
            return $this->getAttribute("name");
        }
        if ($name == "type") {
            return $this->getAttribute("type");
        }
        if ($name == "value") {
            return $this->getAttribute("value");
        }

        return parent::__get($name);
    }

    public function __set($name, $value)
    {
        if ($name == "autofocus") {
            if ($value) {
                $this->setAttribute("autofocus", "");
            } else {
                $this->removeAttribute("autofocus");
            }
        }
        if ($name == "disabled") {
            if ($value) {
                $this->setAttribute("disabled", "");
            } else {
                $this->removeAttribute("disabled");
            }
        }
        if ($name == "name") {
            $this->setAttribute("name", $value);
        }
        if ($name == "type") {
            $this->setAttribute("type", $value);
        }
        if ($name == "value") {
            $this->setAttribute("value", $value);
        }

        parent::__set($name, $value);
    }
}
