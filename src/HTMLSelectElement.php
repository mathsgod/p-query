<?php

namespace P;

/**
 * @property bool $autofocus
 * @property bool $disabled
 * @property-read ?HTMLFormElement $form
 * @property int $length
 * @property bool $multiple
 * @property ?string $name
 * @property-read HTMLOptionsCollection $options
 * @property bool $required
 * 
 */
class HTMLSelectElement extends HTMLElement
{
    const ATTRIBUTES = [
        "autofocus" => "bool",
        "disabled" => "bool",
        "multiple" => "bool",
        "name" => "string",
        "required" => "bool",
        "size" => "int"
    ] + parent::ATTRIBUTES;

    public function __construct()
    {
        parent::__construct("select");
    }

    public function __set($name, $value)
    {
        switch ($name) {
            case "value":
                foreach (p($this)->find("option") as  $option) {
                    if ($option->value == $value) {
                        $option->selected = true;
                    } else {
                        if (!$this->hasAttribute("multiple")) {
                            $option->select = false;
                        }
                    }
                }
                return;
        }

        parent::__set($name, $value);
    }

    public function __get($name)
    {
        if ($name == "form") {
            return $this->closest("form");
        }

        if ($name == "length") {
            return $this->querySelectorAll("option")->count();
        }

        if ($name == "multiple") {
            return $this->hasAttribute("multiple");
        }

        if ($name == "options") {
            $options = new HTMLOptionsCollection();
            foreach ($this->querySelectorAll("option") as $option) {
                $options->append($option);
            }
            return $options;
        }


        switch ($name) {
            case "value":
                $option = p($this)->find("option[selected]");
                if ($option->count()) {
                    return p($option[0])->val();
                }
                return;
            case "name":
                return $this->getAttribute("name");
        }


        return parent::__get($name);
    }

    public function add(HTMLOptionElement $item)
    {
        $this->appendChild($item);
    }

    public function item($index)
    {
        return $this->getElementsByTagName("option")[$index];
    }
}
