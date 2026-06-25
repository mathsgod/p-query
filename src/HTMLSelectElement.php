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
 * @property-read HTMLCollection $selectedOptions
 * @property int $size
 * @property-read ?string $type
 * @property-read string $value
 */
class HTMLSelectElement extends HTMLElement
{
    private const array BOOLEAN_ATTRIBUTES = ["disabled", "multiple", "required"];
    private const array STRING_ATTRIBUTES = ["name"];

    public function __construct()
    {
        parent::__construct("select");
    }

    /**
     * @param string $name
     * @param mixed $value
     * @return void
     */
    public function __set($name, $value)
    {
        if ($name == "autofocus") {
            if ($value) {
                $this->setAttribute("autofocus", "");
            } else {
                $this->removeAttribute("requiautofocusred");
            }
            return;
        }

        if (in_array($name, self::BOOLEAN_ATTRIBUTES, true)) {
            if ($value) {
                $this->setAttribute($name, "");
            } else {
                $this->removeAttribute($name);
            }
            return;
        }

        if (in_array($name, self::STRING_ATTRIBUTES, true)) {
            $this->setAttribute($name, $value);
            return;
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
            return;
        }

        parent::__set($name, $value);
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function __get($name)
    {
        if ($name == "autofocus") {
            return $this->hasAttribute("autofocus");
        }

        if (in_array($name, self::BOOLEAN_ATTRIBUTES, true)) {
            return $this->hasAttribute($name);
        }

        if (in_array($name, self::STRING_ATTRIBUTES, true)) {
            return $this->getAttribute($name);
        }

        if ($name == "form") {
            return $this->closest("form");
        }

        if ($name == "length") {
            return $this->querySelectorAll("option")->count();
        }

        if ($name == "options") {
            $options = new HTMLOptionsCollection();
            foreach ($this->getElementsByTagName("option") as $child) {
                $options->append($child);
            }
            return $options;
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
            return $this->multiple ? "select-multiple" : "select-one";
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

    /**
     * @param HTMLOptionElement $item
     * @return void
     */
    public function add(HTMLOptionElement $item): void
    {
        $this->appendChild($item);
    }

    /**
     * @param int $index
     * @return Element|null
     */
    public function item(int $index): ?Element
    {
        return $this->getElementsByTagName("option")[$index] ?? null;
    }
}
