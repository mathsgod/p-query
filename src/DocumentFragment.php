<?php

namespace P;

use DOMDocumentFragment;

/**
 * @property-read Element $firstElementChild
 */
class DocumentFragment extends DOMDocumentFragment
{

    function __construct()
    {
        parent::__construct();
        Document::Current()->appendChild($this);
    }

    function __get($name)
    {
        switch ($name) {
            case "firstElementChild":
                return $this->firstChild;
        }
    }
}
