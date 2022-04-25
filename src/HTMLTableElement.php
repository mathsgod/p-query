<?php

namespace P;

use DOMException;

/**
 * @property HTMLTableCaptionElement $caption
 * @property string $align //deprecated
 * @property HTMLTableCaptionElement $caption
 * @property HTMLTableSectionElement $tHead
 * @property HTMLTableSectionElement $tFoot
 * @property-read HTMLCollection $rows
 * @property-read HTMLCollection $tBodies
 */
class HTMLTableElement extends HTMLElement
{
    public function __construct($value = "", $uri = null)
    {
        parent::__construct("table", $value, $uri);
    }

    public function __get($name)
    {
        if ($name === "caption") {
            return $this->getElementsByTagName("caption")->item(0);
        }

        if ($name === "align") {
            return $this->getAttribute("align");
        }

        if ($name === "tHead") {
            return $this->getElementsByTagName("thead")->item(0);
        }

        if ($name === "tFoot") {
            return $this->getElementsByTagName("tfoot")->item(0);
        }

        if ($name === "rows") {
            $collection = new HTMLCollection();
            foreach ($this->getElementsByTagName("tr") as $element) {
                $collection->append($element);
            }
            return $collection;
        }

        if ($name === "tBodies") {
            $collection = new HTMLCollection();
            foreach ($this->getElementsByTagName("tbody") as $element) {
                $collection->append($element);
            }
            return $collection;
        }

        return parent::__get($name);
    }

    public function __set($name, $value)
    {
        switch ($name) {
            case "align":
                $this->setAttribute("align", $value);
                break;
            case "caption":
                if ($value instanceof HTMLTableCaptionElement) {
                    //remove old caption
                    foreach ($this->childNodes as $node) {
                        if ($node instanceof HTMLTableCaptionElement) {
                            $this->removeChild($node);
                        }
                    }
                    $this->appendChild($value);
                } else {
                    throw new DOMException("HierarchyRequestError");
                }
                break;
            case "tHead":
                if (!$value instanceof Element) {
                    throw new TypeError("The provided value is not of type 'Element'.");
                }

                if ($value && $value->tagName != "thead") {
                    throw new DOMException("Not a thead element.");
                }

                $this->deleteTHead();

                if (!$value)
                    return;

                for ($child = $this->firstChildElement; $child; $child = $child->nextElementSibling) {
                    if (!$child->tagName != "caption" && !$child->tagName != "colgroup") {
                        break;
                    }
                }
                $this->insertBefore($value, $child);
                return;
            case "tFoot":
                if (!$value instanceof HTMLTableSectionElement) {
                    throw new TypeError("The provided value is not of type 'Element'.");
                }

                if ($value && $value->tagName != "tfoot") {
                    throw new DOMException("Not a tfoot element.");
                }

                $this->deleteTFoot();
                if ($value)
                    $this->appendChild($value);

                return;
        }

        parent::__set($name, $value);
    }


    /**
     * Returns a HTMLTableSectionElement representing a new <tbody> that is a child of the element. It is inserted in the tree after the last element that is a <tbody>, or as the last child if there is no such element.
     */
    function createTBody(): HTMLTableSectionElement
    {
        $tbody = $this->ownerDocument->createElement("tbody");

        if ($this->tBodies->length == 0) {
            $this->appendChild($tbody);
        } else {
            //find last body
            $this->tBodies[$this->tBodies->length - 1]->after($tbody);
        }

        return $tbody;
    }

    public function createTHead(): HTMLTableSectionElement
    {
        if ($this->tHead) {
            return $this->tHead;
        }
        $thead = $this->ownerDocument->createElement('thead');
        $this->prependChild($thead);
        return $thead;
    }

    public function createTFoot(): HTMLTableSectionElement
    {
        if ($this->tFoot) {
            return $this->tFoot;
        }
        $tfoot = $this->ownerDocument->createElement('tfoot');
        $this->appendChild($tfoot);
        return $tfoot;
    }

    public function insertRow($index = -1)
    {
        if ($this->tBodies->length == 0) {
            $tbody = $this->createTBody();
        } else {
            $tbody = $this->tBodies[$this->tBodies->length - 1];
        }
        return $tbody->insertRow($index);
    }

    public function deleteTHead()
    {
        if ($thead = $this->tHead) {
            $thead->remove();
        }
    }

    public function deleteCaption()
    {
        if ($caption = $this->caption) {
            $caption->remove();
        }
    }

    public function deleteTFoot()
    {
        if ($tfoot = $this->tfoot) {
            $tfoot->remove();
        }
    }

    public function deleteRow(int $index)
    {
        /**
         * Removes the row corresponding to the index given in parameter. If the index value is -1 the last row is removed; if it is smaller than -1 or greater than the amount of rows in the collection, a DOMException with the value IndexSizeError is raised.
         */
        if ($this->tBodies->length == 0) {
            $tbody = $this->createTBody();
        } else {
            $tbody = $this->tBodies[$this->tBodies->length - 1];
        }
        return $tbody->deleteRow($index);
    }
}
