<?php

namespace P;

/**
 * @property-read DocumentFragment $content A read-only DocumentFragment which contains the DOM subtree representing the <template> element's template contents.
 */
class HTMLTemplateElement extends HTMLElement
{
    public function __construct(string|null $value = "", string|null $namespace = null)
    {
        parent::__construct("template", $value, $namespace);
    }

    public function __get($name)
    {
        if ($name === "content") {

            $fragment = $this->ownerDocument->createDocumentFragment();

            foreach ($this->childNodes as $node) {
                $fragment->appendChild($node);
            }
            return $fragment;
        }

        return parent::__get($name);
    }
}
