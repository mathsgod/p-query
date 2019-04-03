<?php
namespace P;

class HTMLSelectElement extends HTMLElement
{
    public function __construct($value = "", $uri = null)
    {
        parent::__construct("select", $value, $uri);
    }

    public function __set($name, $value)
    {

        switch ($name) {
            case "required":
            case "multiple":
                $this->setAttribute($name, $value);
                return;
            case "name":
                $this->setAttribute($name, $value);
                return;
            case "value":
                foreach (p($this)->find("option") as  $option) {
                    if (p($option)->val() == $value) {
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
                $options = new HTMLOptionsCollection();
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

    public function options($arrs)
    {
        foreach ($arrs as $v) {
            $item = new HTMLOptionElement($v, $v);
            $this->add($item);
        }
        return;
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
