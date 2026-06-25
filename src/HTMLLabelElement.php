<?php

namespace P;

/**
 * @property-read HTMLElement|null $control Is a HTMLElement representing the control with which the label is associated.
 * @property-read HTMLFormElement|null $form Is a HTMLFormElement object representing the form with which the labeled control is associated, or null if there is no associated control, or if that control isn't associated with a form. In other words, this is just a shortcut for HTMLLabelElement.control.form.
 * @property string $htmlFor Is a string containing the ID of the labeled control. This reflects the for attribute.
 */
class HTMLLabelElement extends HTMLElement
{
    public function __construct(string|null $value = "", string|null $namespace = null)
    {
        parent::__construct("label", $value, $namespace);
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function __get($name)
    {
        if ($name === "control") {
            $for = $this->getAttribute("for");
            if ($for === "") {
                return null;
            }
            return $this->ownerDocument->getElementById($for);
        }

        if ($name === "form") {
            $control = $this->control;
            if ($control === null) {
                return null;
            }
            return $control->form;
        }

        if ($name === "htmlFor") {
            return $this->getAttribute("for");
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
        if ($name === "htmlFor") {
            $this->setAttribute("for", $value);
        } else {
            parent::__set($name, $value);
        }
    }
}
