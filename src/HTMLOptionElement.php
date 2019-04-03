<?php
namespace P;

class HTMLOptionElement extends HTMLElement
{
    public function __construct($text = null, $value = null, $defaultSelected = false)
    {
        parent::__construct("option");
        /*if ($value) {
            $this->attributes["value"] = $value;
        }

        $this->attributes["selected"] = $defaultSelected;
        if ($text) {
            $this->appendChild(new Text($text));
        }*/
    }

    public function __set($name, $value)
    {

        switch ($name) {
            case "selected":
                $this->setAttribute($name, $value);
                return;
        }
        parent::__set($name, $value);
    }
}
