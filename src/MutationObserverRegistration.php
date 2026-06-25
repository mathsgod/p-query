<?php

namespace P;

class MutationObserverRegistration
{
    public array $options = [];

    public MutationObserver $observer;

    public Element $element;

    public function __construct(MutationObserver $observer, Element $element, array $options)
    {
        $this->observer = $observer;
        $this->element = $element;
        $this->options = $options;
    }
}
