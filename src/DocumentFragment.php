<?php

namespace P;

/**
 * @property-read Element|null $firstElementChild
 */
class DocumentFragment extends \DOMDocumentFragment
{
    public function __construct()
    {
        parent::__construct();
        @Document::Current()->appendChild($this);
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function __get($name)
    {
        switch ($name) {
            case "firstElementChild":
                return $this->firstChild;
        }
        return null;
    }
}
