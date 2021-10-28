<?php

namespace P;

/**
 * @property-read DOMStringMap $dataset
 * @property string $title
 * @property string $innerText
 * @property bool $hidden The HTMLElement property hidden is a boolean value which is true if the element is hidden; otherwise the value is false. This is quite different from using the CSS property display to control the visibility of an element.
 * @property string $lang The HTMLElement.lang property gets or sets the base language of an element's attribute values and text content.
 * @property string $contentEditable
 * @property string $dir
 * @property int $tabIndex
 */
class HTMLElement extends Element
{

    const ATTRIBUTES = [];

    public function __set($name, $value)
    {
        switch ($name) {
            case "tabIndex":
                $this->setAttribute("tabindex", $value);
                return;
            case "dir":
                $this->setAttribute("dir", $value);
                return;
            case "contentEditable":
                $this->setAttribute("contenteditable", $value);
                return;
            case "lang":
                $this->setAttribute("lang", $value);
                return;
            case "hidden":
                if ($value) {
                    $this->setAttribute("hidden", true);
                } else {
                    $this->removeAttribute("hidden");
                }
                return;
            case "innerText":
                $this->textContent = $value;
                return;
            case "title":
                $this->setAttribute("title", $value);
                return;
        }

        if (array_key_exists($name, static::ATTRIBUTES)) {

            $attr = static::ATTRIBUTES[$name];
            if (is_array($attr)) {
                $name = $attr["name"];
                $type = $attr["type"];
            } else {
                $name = strtolower($name);
                $type = "string";
            }


            if ($type == "json") {
                $value = json_encode($value, JSON_UNESCAPED_UNICODE);
            }

            $this->setAttribute($name, $value);
            return;
        }
        parent::__set($name, $value);
    }

    public function __get($name)
    {
        switch ($name) {
            case "tabIndex":
                if (!$this->hasAttribute("tabindex")) return -1;
                return intval($this->getAttribute("tabindex"));
            case "dir":
                return $this->getAttribute("dir");
            case "contentEditable":
                if (!$this->hasAttribute("contenteditable")) return "inherit";
                return $this->getAttribute("contenteditable");
            case "lang":
                return $this->getAttribute("lang");
            case "hidden":
                return $this->hasAttribute("hidden");
            case "dataset":
                $map = new DOMStringMap($this);
                return $map;
                break;
            case 'innerText':
                return $this->textContent;
                break;
            case "title":
                return $this->getAttribute("title");
        }

        if (array_key_exists($name, static::ATTRIBUTES)) {
            $attr = static::ATTRIBUTES[$name];
            if (is_array($attr)) {
                $name = $attr["name"];
                $type = $attr["type"];
            } else {
                $name = strtolower($name);
                $type = "string";
            }

            $value = $this->getAttribute($name);

            if ($type == "json") {
                $value = json_decode($value, true);
            }
            return $value;
        }
        return parent::__get($name);
    }
}
