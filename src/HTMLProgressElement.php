<?php

namespace P;

/**
 * The HTMLProgressElement interface provides special properties (beyond the regular HTMLElement interface it also has available to it by inheritance) for manipulating <progress> elements.
 * @property double $max This attribute indicates the maximum value of the <progress> element.
 * @property-read double $position This attribute indicates the current value of the <progress> element.
 * @property double $value This attribute indicates the current value of the <progress> element.
 */
class ProgressElement extends HTMLElement
{
    public function __construct()
    {
        parent::__construct('progress');
    }

    function __get($name)
    {
        switch ($name) {
            case 'max':
                return doubleval($this->getAttribute('max'));
            case 'position':
                return doubleval($this->getAttribute('position')) / $this->max;
            case 'value':
                return doubleval($this->getAttribute('value'));
            default:
                return parent::__get($name);
        }
    }

    function __set($name, $value)
    {
        switch ($name) {
            case 'max':
                $this->setAttribute('max', $value);
                break;
            case 'value':
                $this->setAttribute('value', $value);
                break;
            default:
                parent::__set($name, $value);
        }
    }
}
