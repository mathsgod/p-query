<?php

namespace P;

use DOMException;

class HTMLTableSectionElement extends HTMLElement
{
    /**
     * Inserts a new row at the end of the section.
     */
    public function insertRow(): HTMLTableRowElement
    {
        $row = $this->ownerDocument->createElement("tr");
        $this->appendChild($row);
        return $row;
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function __get($name)
    {
        switch ($name) {
            case "rows":
                $collection = new HTMLCollection();
                foreach ($this->childNodes as $node) {
                    $collection[] = $node;
                }
                return $collection;
        }
        return parent::__get($name);
    }

    /**
     * Removes the row, corresponding to the index given in parameter, in the section. If the index value is -1 the last row is removed; if it smaller than -1 or greater than the amount of rows in the collection, a DOMException with the value IndexSizeError is raised.
     */
    public function deleteRow(int $index): void
    {
        if ($index < -1 || $index >= $this->rows->length) {
            throw new DOMException("IndexSizeError");
        }

        if ($index == -1) {
            $this->removeChild($this->childNodes[$this->childNodes->length - 1]);
        } else {
            $this->removeChild($this->childNodes[$index]);
        }
    }
}
