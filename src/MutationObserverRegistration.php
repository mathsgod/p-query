<?php

namespace P;

class MutationObserverRegistration
{

    public array $options = [];
    public $observer;

    /**
     * @var Element $element
     */
    public $element;

    function __construct(MutationObserver $observer, Element $element, $options)
    {
        $this->observer = $observer;
        $this->element = $element;
        $this->options = $options;
    }
}
