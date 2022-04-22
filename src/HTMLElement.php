<?php

namespace P;

/**
 * @property string $accessKey A string representing the access key assigned to the element.
 * @property string $contentEditable A string, where a value of true means the element is editable and a value of false means it isn't.
 * @property-read DOMStringMap $dataset Returns a DOMStringMap with which script can read and write the element's custom data attributes (data-*) .
 * @property string $dir A string, reflecting the dir global attribute, representing the directionality of the element. Possible values are "ltr", "rtl", and "auto".
 * @property bool $draggable A boolean value indicating if the element can be dragged.
 * @property bool $hidden A boolean value indicating if the element is hidden or not.
 * @property bool $inert A boolean value indicating whether the user agent must act as though the given node is absent for the purposes of user interaction events, in-page text searches ("find in page"), and text selection.
 * @property string $innerText Represents the rendered text content of a node and its descendants. As a getter, it approximates the text the user would get if they highlighted the contents of the element with the cursor and then copied it to the clipboard. As a setter, it replaces the content inside the selected element, converting any line breaks into <br> elements.
 * @property string $lang A string representing the language of an element's attributes, text, and element contents.
 * @property CSSStyleDeclaration $style A CSSStyleDeclaration representing the declarations of the element's style attribute.
 * @property string $tabIndex A long representing the position of the element in the tabbing order.
 * @property string $title A string containing the text that appears in a popup box when mouse is over the element.
 */
class HTMLElement extends Element
{

    const ATTRIBUTES = [];

    public function __get($name)
    {
        if ($name == "accessKey") {
            return $this->getAttribute("accesskey");
        }

        if ($name == "contentEditable") {
            if ($this->hasAttribute("contenteditable")) {
                return $this->getAttribute("contenteditable");
            } else {
                return "inherit";
            }
        }

        if ($name == "dataset") {
            return new DOMStringMap($this);
        }

        if ($name == "dir") {
            return $this->getAttribute("dir");
        }

        if ($name == "draggable") {
            return $this->hasAttribute("draggable");
        }

        if ($name == "hidden") {
            return $this->hasAttribute("hidden");
        }

        if ($name == "inert") {
            return $this->hasAttribute("inert");
        }

        if ($name == "innerText") {
            return $this->textContent;
        }

        if ($name == "lang") {
            return $this->getAttribute("lang");
        }

        if ($name == "style") {
            if (!$this->hasAttribute("style")) {
                $this->setAttribute("style", "");
            }
            return new CSSStyleDeclaration($this->attributes->getNamedItem("style"));
        }

        if ($name == "tabIndex") {
            if ($this->hasAttribute("tabindex")) {
                return $this->getAttribute("tabindex");
            } else {
                return -1;
            }
        }

        if ($name == "title") {
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

    public function __set($name, $value)
    {
        if ($name == "accessKey") {
            $this->setAttribute("accesskey", $value);
        }

        if ($name == "contentEditable") {
            $this->setAttribute("contenteditable", $value);
        }

        if ($name == "dir") {
            $this->setAttribute("dir", $value);
        }

        if ($name == "draggable") {
            if ($value) {
                $this->setAttribute("draggable", "true");
            } else {
                $this->removeAttribute("draggable");
            }
        }

        if ($name == "hidden") {
            if ($value) {
                $this->setAttribute("hidden", "true");
            } else {
                $this->removeAttribute("hidden");
            }
        }

        if ($name == "inert") {
            if ($value) {
                $this->setAttribute("inert", "true");
            } else {
                $this->removeAttribute("inert");
            }
        }

        if ($name == "innerText") {
            $this->textContent = $value;
        }

        if ($name == "lang") {
            $this->setAttribute("lang", $value);
        }

        if ($name == "style") {
            $this->style->cssText = $value;
        }

        if ($name == "tabIndex") {
            $this->setAttribute("tabindex", $value);
        }

        if ($name == "title") {
            $this->setAttribute("title", $value);
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
                $value = json_encode($value);
            }
            $this->setAttribute($name, $value);
        }

        parent::__set($name, $value);
    }
}
