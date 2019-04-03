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
                if ($value) {
                    $this->setAttribute($name);
                } else {
                    $this->removeAttribute($name);
                }
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
