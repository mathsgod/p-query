<?php

namespace P;

/**
 * @property bool $autofocus
 * @property bool $disabled
 * @property-read ?HTMLFormElement $form
 * @property int $length
 * @property bool $multiple
 * @property string $name
 * @property-read HTMLOptionsCollection $options
 * @property bool $required
 * @property int $selectedIndex A long reflecting the index of the first selected <option> element. The value -1 indicates no element is selected.
 * @property-read HTMLCollection<HTMLElement> $selectedOptions
 * @property int $size
 * @property-read ?string $type
 * @property-read string $value
 */
class HTMLSelectElement extends HTMLElement
{
    public function __construct()
    {
        parent::__construct("select");
    }

    public function __set($name, $value)
    {

        if ($name == "autofocus") {
            if ($value) {
                $this->setAttribute("autofocus", "");
            } else {
                $this->removeAttribute("requiautofocusred");
            }
        }

        if ($name == "disabled") {
            if ($value) {
                $this->setAttribute("disabled", "");
            } else {
                $this->removeAttribute("disabled");
            }
        }

        if ($name == "multiple") {
            if ($value) {
                $this->setAttribute("multiple", "");
            } else {
                $this->removeAttribute("multiple");
            }
        }

        if ($name == "name") {
            $this->setAttribute("name", $value);
        }

        if ($name == "required") {
            if ($value) {
                $this->setAttribute("required", "");
            } else {
                $this->removeAttribute("required");
            }
        }

        if ($name === "selectedIndex") {
            if ($value === -1) {
                foreach ($this->options as $option) {
                    $option->selected = false;
                }
            } else {
                $this->options[$value]->selected = true;
            }
            return;
        }


        if ($name == "value") {
            foreach ($this->options as $option) {
                if ($option->value == $value) {
                    $option->selected = true;
                } else {
                    $option->selected = false;
                }
            }
        }

        parent::__set($name, $value);
    }

    public function __get($name)
    {

        if ($name == "autofocus") {
            return $this->hasAttribute("autofocus");
        }

        if ($name == "disabled") {
            return $this->hasAttribute("disabled");
        }

        if ($name == "form") {
            return $this->closest("form");
        }

        if ($name == "length") {
            return $this->querySelectorAll("option")->count();
        }

        if ($name == "name") {
            return $this->getAttribute("name");
        }

        if ($name == "multiple") {
            return $this->hasAttribute("multiple");
        }

        if ($name == "options") {

            $options = new HTMLOptionsCollection();
            foreach ($this->getElementsByTagName("option") as $child) {
                $options->append($child);
            }
            return $options;
        }

        if ($name == "required") {
            return $this->hasAttribute("required");
        }

        if ($name == "selectedIndex") {
            $index = 0;
            foreach ($this->options as $option) {
                if ($option->selected) {
                    return $index;
                }
                $index++;
            }
            return -1;
        }

        if ($name == "selectedOptions") {
            $options = new HTMLCollection();
            foreach ($this->options as $option) {
                if ($option->selected) {
                    $options->append($option);
                }
            }
            return $options;
        }

        if ($name == "type") {
            if ($this->multiple) {
                return "select-multiple";
            } else {
                return "select-one";
            }
        }

        if ($name == "value") {
            foreach ($this->options as $option) {
                if ($option->selected) {
                    return $option->value;
                }
            }
            return "";
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
