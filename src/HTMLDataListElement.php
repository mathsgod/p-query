<?php

namespace P;

/**
 * @property-read HTMLCollection $options
 */
class HTMLDataListElement extends HTMLElement
{
    public function __construct(string|null $value = "", string|null $namespace = null)
    {
        parent::__construct("datalist", $value, $namespace);
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function __get($name)
    {
        if ($name === "options") {
            return new HTMLCollection(iterator_to_array($this->getElementsByTagName("option")));
        }

        return parent::__get($name);
    }
}
