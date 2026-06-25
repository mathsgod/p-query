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
    private const array BOOLEAN_ATTRIBUTES = ["autofocus", "disabled"];
    private const array STRING_ATTRIBUTES = ["name", "type", "value"];

    public function __construct(string|null $value = "", string|null $namespace = null)
    {
        parent::__construct("button", $value, $namespace);
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function __get($name)
    {
        if (in_array($name, self::BOOLEAN_ATTRIBUTES, true)) {
            return $this->hasAttribute($name);
        }

        if (in_array($name, self::STRING_ATTRIBUTES, true)) {
            return $this->getAttribute($name);
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
        if (in_array($name, self::BOOLEAN_ATTRIBUTES, true)) {
            if ($value) {
                $this->setAttribute($name, "");
            } else {
                $this->removeAttribute($name);
            }
            return;
        }

        if (in_array($name, self::STRING_ATTRIBUTES, true)) {
            $this->setAttribute($name, $value);
            return;
        }

        parent::__set($name, $value);
    }
}
