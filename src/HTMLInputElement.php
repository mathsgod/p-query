<?php

namespace P;

use DateTime;
use DOMNodeList;

/**
 * @property bool $autofocus
 * @property string $defaultValue
 * @property string $dirName
 * @property-read NodeList $labels
 * @property-read ?HTMLDataListElement $list
 * @property bool $multiple
 * @property string $name
 * @property string $step
 * @property string $type
 * @property string $value
 * @property Date $valueAsDate
 * @property int $valueAsNumber
 * 
 * Properties related to the parent form
 * @property-read ?HTMLFormElement $form
 * @property string $formAction
 * @property string $formEnctype
 * @property string $formMethod
 * @property string $formNoValidate
 * @property string $formTarget
 * 
 * Properties that apply only to elements of type checkbox or radio
 * @property bool $checked
 * @property bool $defaultChecked
 * @property bool $indeterminate
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
class HTMLInputElement extends HTMLElement
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
                $id = $this->id;
                if ($id) {
                    return $this->ownerDocument->querySelectorAll("label[for=\"$id\"]");
                }
                return new DOMNodeList;
            case "list":
                $list = $this->getAttribute("list");
                if ($list) {
                    return $this->ownerDocument->querySelector("datalist#$list");
                }
                return null;
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
                return new DateTime($this->getAttribute("value"));
            case "valueAsNumber":
                return (int) $this->getAttribute("value");
            case "form":
                return $this->closest("form");
            case "formAction":
                return $this->form->getAttribute("formaction");
            case "formMethod":
                return $this->form->getAttribute("formmethod");
            case "formNoValidate":
                return $this->form->hasAttribute("formnovalidate");
            case "formTarget":
                return $this->form->getAttribute("formtarget");
            case "checked":
                return $this->hasAttribute("checked");
            case "defaultChecked":
                return $this->hasAttribute("checked");
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
                return (int)$this->getAttribute("maxLength");
            case "min":
                return $this->getAttribute("min");
            case "minLength":
                return (int)$this->getAttribute("minLength");
            case "pattern":
                return $this->getAttribute("pattern");
            case "placeholder":
                return $this->getAttribute("placeholder");
            case "readOnly":
                return $this->hasAttribute("readonly");
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
                $this->setAttribute("value", $value->format("Y-m-d"));
                break;
            case "valueAsNumber":
                $this->setAttribute("value", $value);
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
            case "src":
                $this->setAttribute("src", $value);
                break;
            case "width":
                $this->setAttribute("width", $value);
                break;
            case "accept":
                $this->setAttribute("accept", $value);
                break;
            case "autocomplete":
                $this->setAttribute("autocomplete", $value);
                break;
            case "max":
                $this->setAttribute("max", $value);
                break;
            case "maxLength":
                $this->setAttribute("maxLength", $value);
                break;
            case "min":
                $this->setAttribute("min", $value);
                break;
            case "minLength":
                $this->setAttribute("minLength", $value);
                break;
            case "pattern":
                $this->setAttribute("pattern", $value);
                break;
            case "placeholder":
                $this->setAttribute("placeholder", $value);
                break;
            case "readOnly":
                if ($value) {
                    $this->setAttribute("readonly", "");
                } else {
                    $this->removeAttribute("readonly");
                }
                break;
            case "size":
                $this->setAttribute("size", $value);
                break;
        }

        parent::__set($name, $value);
    }
}
