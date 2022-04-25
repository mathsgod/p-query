<?php

namespace P;

/**
 * @property bool $autofocus
 * @property int $cols
 * @property string $defaultValue
 * @property bool $disabled
 * @property-read HTMLFormElement $form
 * @property int $maxLength
 * @property int $minLength
 * @property string $name
 * @property string $placeholder
 * @property bool $readOnly
 * @property bool $required
 * @property int $rows
 * @property string $selectionDirection
 * @property int $tabIndex
 * @property-read int $textLength
 * @property-read string $type
 * @property-read string $validationMessage
 * @property string $value;
 * @property string $wrap
 *
 **/

class HTMLTextAreaElement extends HTMLElement
{
    public function __construct($value = "", $uri = null)
    {
        parent::__construct("textarea", $value, $uri);
    }

    public function __get($name)
    {
        if ($name == "autofocus") {
            return $this->hasAttribute("autofocus");
        }

        if ($name == "cols") {
            if ($this->hasAttribute("cols")) {
                return (int) $this->getAttribute("cols");
            } else {
                return 20;
            }
        }

        if ($name == "defaultValue") {
            return $this->getAttribute("value");
        }

        if ($name == "disabled") {
            return $this->hasAttribute("disabled");
        }

        if ($name == "form") {
            return $this->closest("form");
        }

        if ($name == "maxLength") {
            if ($this->hasAttribute("maxlength")) {
                return (int) $this->getAttribute("maxlength");
            } else {
                return -1;
            }
        }

        if ($name == "minLength") {
            if ($this->hasAttribute("minlength")) {
                return (int) $this->getAttribute("minlength");
            } else {
                return -1;
            }
        }

        if ($name == "name") {
            return $this->getAttribute("name");
        }

        if ($name == "placeholder") {
            return $this->getAttribute("placeholder");
        }

        if ($name == "readOnly") {
            return $this->hasAttribute("readonly");
        }

        if ($name == "required") {
            return $this->hasAttribute("required");
        }

        if ($name == "textLength") {
            return strlen($this->nodeValue);
        }

        if ($name == "value") {
            return $this->nodeValue;
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

        if ($name == "cols") {
            $this->setAttribute("cols", $value);
        }

        if ($name == "defaultValue") {
            $this->setAttribute("value", $value);
        }

        if ($name == "disabled") {
            if ($value) {
                $this->setAttribute("disabled", "");
            } else {
                $this->removeAttribute("disabled");
            }
        }

        if ($name == "maxLength") {
            $this->setAttribute("maxlength", $value);
        }

        if ($name == "minLength") {
            $this->setAttribute("minlength", $value);
        }

        if ($name == "name") {
            $this->setAttribute("name", $value);
        }

        if ($name == "placeholder") {
            $this->setAttribute("placeholder", $value);
        }

        if ($name == "readOnly") {
            if ($value) {
                $this->setAttribute("readonly", "");
            } else {
                $this->removeAttribute("readonly");
            }
        }

        if ($name == "required") {
            if ($value) {
                $this->setAttribute("required", "");
            } else {
                $this->removeAttribute("required");
            }
        }

        if ($name == "rows") {
            $this->setAttribute("rows", $value);
        }

        if ($name == "selectionDirection") {
            $this->setAttribute("selectionDirection", $value);
        }

        if ($name == "tabIndex") {
            $this->setAttribute("tabindex", $value);
        }

        if ($name == "value") {
            $this->nodeValue = $value;
        }


        parent::__set($name, $value);
    }
}
