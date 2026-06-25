<?php

namespace P;

use DateTime;
use DOMNodeList;

/**
 * @property bool $autofocus
 * @property string $defaultValue
 * @property string $dirName
 * @property-read DOMNodeList $labels
 * @property-read ?HTMLDataListElement $list
 * @property bool $multiple
 * @property string $name
 * @property string $step
 * @property string $type
 * @property string $value
 * @property DateTime $valueAsDate
 * @property int $valueAsNumber
 *
 * Properties related to the parent form
 * @property-read ?HTMLFormElement $form
 * @property string $formAction
 * @property string $formMethod
 * @property bool $formNoValidate
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
    private const array BOOLEAN_GET_ATTRIBUTES = [
        "autofocus" => "autofocus",
        "multiple" => "multiple",
        "checked" => "checked",
        "defaultChecked" => "checked",
        "readOnly" => "readonly",
    ];

    private const array BOOLEAN_SET_ATTRIBUTES = [
        "autofocus" => "autofocus",
        "multiple" => "multiple",
        "checked" => "checked",
        "defaultChecked" => "defaultChecked",
        "indeterminate" => "indeterminate",
        "readOnly" => "readonly",
    ];

    private const array STRING_GET_ATTRIBUTES = [
        "defaultValue" => "value",
        "dirName" => "dirname",
        "name" => "name",
        "step" => "step",
        "type" => "type",
        "value" => "value",
        "indeterminate" => "indeterminate",
        "alt" => "alt",
        "height" => "height",
        "src" => "src",
        "width" => "width",
        "accept" => "accept",
        "autocomplete" => "autocomplete",
        "max" => "max",
        "pattern" => "pattern",
        "placeholder" => "placeholder",
        "size" => "size",
    ];

    private const array STRING_SET_ATTRIBUTES = [
        "defaultValue" => "value",
        "dirName" => "dirname",
        "name" => "name",
        "step" => "step",
        "type" => "type",
        "value" => "value",
        "alt" => "alt",
        "height" => "height",
        "src" => "src",
        "width" => "width",
        "accept" => "accept",
        "autocomplete" => "autocomplete",
        "max" => "max",
        "pattern" => "pattern",
        "placeholder" => "placeholder",
        "size" => "size",
    ];

    private const array INTEGER_ATTRIBUTES = [
        "maxLength" => "maxLength",
        "minLength" => "minLength",
    ];

    public function __construct(string|null $value = "", string|null $namespace = null)
    {
        parent::__construct("input", $value, $namespace);
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function __get($name)
    {
        switch ($name) {
            case "labels":
                $id = $this->id;
                if ($id) {
                    return $this->ownerDocument->querySelectorAll("label[for=\"$id\"]");
                }
                return new DOMNodeList();
            case "list":
                $list = $this->getAttribute("list");
                if ($list) {
                    return $this->ownerDocument->querySelector("datalist#$list");
                }
                return null;
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
        }

        if (array_key_exists($name, self::BOOLEAN_GET_ATTRIBUTES)) {
            return $this->hasAttribute(self::BOOLEAN_GET_ATTRIBUTES[$name]);
        }

        if (array_key_exists($name, self::STRING_GET_ATTRIBUTES)) {
            return $this->getAttribute(self::STRING_GET_ATTRIBUTES[$name]);
        }

        if (array_key_exists($name, self::INTEGER_ATTRIBUTES)) {
            return (int) $this->getAttribute(self::INTEGER_ATTRIBUTES[$name]);
        }

        return parent::__get($name);
    }

    /**
     * @param string $name
     * @param mixed $value
     * @return void
     */
    public function __set($name, $value)
    {
        switch ($name) {
            case "valueAsDate":
                $this->setAttribute("value", $value->format("Y-m-d"));
                break;
            case "valueAsNumber":
                $this->setAttribute("value", $value);
                break;
        }

        if (array_key_exists($name, self::BOOLEAN_SET_ATTRIBUTES)) {
            if ($value) {
                $this->setAttribute(self::BOOLEAN_SET_ATTRIBUTES[$name], "");
            } else {
                $this->removeAttribute(self::BOOLEAN_SET_ATTRIBUTES[$name]);
            }
        } elseif (array_key_exists($name, self::STRING_SET_ATTRIBUTES)) {
            $this->setAttribute(self::STRING_SET_ATTRIBUTES[$name], $value);
        } elseif (array_key_exists($name, self::INTEGER_ATTRIBUTES)) {
            $this->setAttribute(self::INTEGER_ATTRIBUTES[$name], $value);
        }

        parent::__set($name, $value);
    }
}
