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
     * Returns an HTMLTableSectionElement representing the first <thead> that is a child of the element. If none is found, a new one is created and inserted in the tree immediately before the first element that is neither a <caption>, nor a <colgroup>, or as the last child if there is no such element.
     */
    public function createTHead(): HTMLTableSectionElement
    {
        if ($this->tHead) {
            return $this->tHead;
        }
        $thead = $this->ownerDocument->createElement('thead');
        $this->prependChild($thead);
        return $thead;
    }

    /**
     * Removes the first <thead> that is a child of the element.
     */
    public function deleteTHead()
    {
        if ($this->tHead) {
            $this->removeChild($this->tHead);
        }
    }

    /**
     * Returns an HTMLTableSectionElement representing the first <tfoot> that is a child of the element. If none is found, a new one is created and inserted in the tree as the last child.
     */
    public function createTFoot(): HTMLTableSectionElement
    {
        if ($this->tFoot) {
            return $this->tFoot;
        }
        $tfoot = $this->ownerDocument->createElement('tfoot');
        $this->appendChild($tfoot);
        return $tfoot;
    }

    /**
     * Removes the first <tfoot> that is a child of the element.
     */
    public function deleteTFoot()
    {
        if ($tFoot = $this->tFoot) {
            $this->removeChild($tFoot);
        }
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

    /**
     * Returns an HTMLElement representing the first <caption> that is a child of the element. If none is found, a new one is created and inserted in the tree as the first child of the <table> element.
     */
    public function createCaption(): HTMLElement
    {
        if ($this->caption) {
            return $this->caption;
        }
        $caption = $this->ownerDocument->createElement("caption");
        $this->prependChild($caption);
        return $caption;
    }

    /**
     * Removes the first <caption> that is a child of the element.
     */
    public function deleteCaption()
    {
        if ($caption = $this->caption) {
            $caption->remove();
        }
    }


    /**
     * Returns an HTMLTableRowElement representing a new row of the table. It inserts it in the rows collection immediately before the <tr> element at the given index position. If necessary a <tbody> is created. If the index is -1, the new row is appended to the collection. If the index is smaller than -1 or greater than the number of rows in the collection, a DOMException with the value IndexSizeError is raised.
     */
    public function insertRow($index = -1): HTMLTableRowElement
    {
        if ($this->tBodies->length == 0) {
            $tbody = $this->createTBody();
        } else {
            $tbody = $this->tBodies[$this->tBodies->length - 1];
        }
        return $tbody->insertRow($index);
    }

    /**
     * Removes the row corresponding to the index given in parameter. If the index value is -1 the last row is removed; if it is smaller than -1 or greater than the amount of rows in the collection, a DOMException with the value IndexSizeError is raised.
     */
    public function deleteRow(int $index)
    {

        if ($this->tBodies->length == 0) {
            $tbody = $this->createTBody();
        } else {
            $tbody = $this->tBodies[$this->tBodies->length - 1];
        }
        return $tbody->deleteRow($index);
    }
}
