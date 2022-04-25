<?php

namespace P;

/**
 * @property-read HTMLElment $control Is a HTMLElement representing the control with which the label is associated.
 * @property-read HTMLFormElement $form Is a HTMLFormElement object representing the form with which the labeled control is associated, or null if there is no associated control, or if that control isn't associated with a form. In other words, this is just a shortcut for HTMLLabelElement.control.form.
 * @property string $htmlFor Is a string containing the ID of the labeled control. This reflects the for attribute.
 */

class HTMLLabelElement extends HTMLElement
{
    function __construct(string|null $value = null, string $namespace = null)
    {
        parent::__construct("label", $value, $namespace);
    }

    function __get($name)
    {
        if ($name === "control") {

            $for = $this->getAttribute("for");
            if ($for === "") {
                return null;
            }
            return $this->ownerDocument->getElementById($for);
        } elseif ($name === "form") {
            $control = $this->control;
            if ($control === null) {
                return null;
            }
            return $control->form;
        } elseif ($name === "htmlFor") {
            return $this->getAttribute("for");
        }

        return parent::__get($name);
    }

    public function __set($name, $value)
    {
        if ($name === "htmlFor") {
            $this->setAttribute("for", $value);
        } else {
            parent::__set($name, $value);
        }
    }
}
