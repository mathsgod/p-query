<?php
namespace P;
class HTMLOptionElement extends HTMLElement {
    public function __construct($text = null, $value = null, $defaultSelected = false) {
        parent::__construct("option");
        if ($value) {
            $this->attributes["value"] = $value;
        }

        $this->attributes["selected"] = $defaultSelected;
        if ($text) {
            $this->appendChild(new Text($text));
        }
    }

    public function __set($name, $value) {
        if ($name == "selected") {
            if ($value) {
                $this->attributes["selected"] = true;
            } else {
                unset($this->attributes["selected"]);
            }
        } else {
            parent::__set($name, $value);
        }
    }
}

?>