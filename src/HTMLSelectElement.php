<?php
namespace P;

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

    public function __construct($value = "", $uri = null)
    {
        parent::__construct("select", $value, $uri);
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
        switch ($name) {
            case "length":
                return p($this)->find("option")->count();
            case "options":
                $options = new OptionCollection();
                foreach (p($this)->find("option") as $option) {
                    $options[] = $option;
                }
                return $options;
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
