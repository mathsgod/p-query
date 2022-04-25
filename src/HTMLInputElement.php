<?php

namespace P;

/**
 * @property bool $autofocus
 * @property string $defaultValue
 * @property string $dirName
 * @property-read NodeList $labels
 * @property-read ?HTMLElement $list
 * @property bool $multiple
 * @property string $name
 * @property string $step
 * @property string $type
 * @property string $value
 * @property Date $valueAsDate
 * @property int $valueAsNumber
 * @property-read ?HTMLFormElement $form
 * 
 * Properties that apply only to elements of type checkbox or radio
 * @property bool $checked
 * @property bool $defaultChecked
 * @property bool $indeterminate
 * 
 * 
 * Properties that apply only to elements of type image
 * @property string $alt
 * @property string $height 
 * @property string $src
 * @property string $width
 * 
 * Properties that apply only to elements of type file
 * @property string $accept
 * 
 * Properties that apply only to visible elements containing text or numbers
 * @property string $autocomplete
 * @property string $max
 * @property int $maxLength
 * @property string $min
 * @property int $minLength
 * @property string $pattern
 * @property string $placeholder
 * @property bool $readOnly
 * @property int $size
 */
class  HTMLInputElement extends HTMLElement
{

    public function __construct($value = "", $uri = null)
    {
        parent::__construct("input", $value, $uri);
    }

    function __get($name)
    {

        switch ($name) {
            case "autofocus":
                return $this->hasAttribute("autofocus");
            case "defaultValue":
                return $this->getAttribute("value");
            case "dirName":
                return $this->getAttribute("dirname");
            case "labels":
                return $this->getElementsByTagName("label");
            case "list":
                return $this->getElementsByTagName("datalist")->item(0);
            case "multiple":
                return $this->hasAttribute("multiple");
            case "name":
                return $this->getAttribute("name");
            case "step":
                return $this->getAttribute("step");
            case "type":
                return $this->getAttribute("type");
            case "value":
                return $this->getAttribute("value");
            case "valueAsDate":
                return $this->getAttribute("valueAsDate");
            case "valueAsNumber":
                return $this->getAttribute("valueAsNumber");
            case "form":
                return $this->closest("form");
            case "checked":
                return $this->getAttribute("checked");
            case "defaultChecked":
                return $this->getAttribute("defaultChecked");
            case "indeterminate":
                return $this->getAttribute("indeterminate");
            case "alt":
                return $this->getAttribute("alt");
            case "height":
                return $this->getAttribute("height");
            case "src":
                return $this->getAttribute("src");
            case "width":
                return $this->getAttribute("width");
            case "accept":
                return $this->getAttribute("accept");
            case "autocomplete":
                return $this->getAttribute("autocomplete");
            case "max":
                return $this->getAttribute("max");
            case "maxLength":
                return $this->getAttribute("maxLength");
            case "min":
                return $this->getAttribute("min");
            case "minLength":
                return $this->getAttribute("minLength");
            case "pattern":
                return $this->getAttribute("pattern");
            case "placeholder":
                return $this->getAttribute("placeholder");
            case "readOnly":
                return $this->hasAttribute("readOnly");
            case "size":
                return $this->getAttribute("size");
        }

        return parent::__get($name);
    }

    function __set($name, $value)
    {

        switch ($name) {
            case "autofocus":
                if ($value) {
                    $this->setAttribute("autofocus", "");
                } else {
                    $this->removeAttribute("autofocus");
                }
                break;
            case "defaultValue":
                $this->setAttribute("value", $value);
                break;
            case "dirName":
                $this->setAttribute("dirname", $value);
                break;
            case "multiple":
                if ($value) {
                    $this->setAttribute("multiple", "");
                } else {
                    $this->removeAttribute("multiple");
                }
                break;
            case "name":
                $this->setAttribute("name", $value);
                break;
            case "step":
                $this->setAttribute("step", $value);
                break;
            case "type":
                $this->setAttribute("type", $value);
                break;
            case "value":
                $this->setAttribute("value", $value);
                break;
            case "valueAsDate":
                $this->setAttribute("valueAsDate", $value);
                break;
            case "valueAsNumber":
                $this->setAttribute("valueAsNumber", $value);
                break;
            case "checked":
                if ($value) {
                    $this->setAttribute("checked", "");
                } else {
                    $this->removeAttribute("checked");
                }
                break;
            case "defaultChecked":
                if ($value) {
                    $this->setAttribute("defaultChecked", "");
                } else {
                    $this->removeAttribute("defaultChecked");
                }
                break;
            case "indeterminate":
                if ($value) {
                    $this->setAttribute("indeterminate", "");
                } else {
                    $this->removeAttribute("indeterminate");
                }
                break;
            case "alt":
                $this->setAttribute("alt", $value);
                break;
            case "height":
                $this->setAttribute("height", $value);
                break;
        }

        parent::__set($name, $value);
    }
}
