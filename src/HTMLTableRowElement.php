<?php

namespace P;

use DOMException;

/**
 * @property-read HTMLCollection $cells Returns a live HTMLCollection containing the cells in the row. The HTMLCollection is live and is automatically updated when cells are added or removed.
 * @property-read int $rowIndex Returns a long value which gives the logical position of the row within the entire table. If the row is not part of a table, returns -1.
 * @property-read int $sectionRowIndex Returns a long value which gives the logical position of the row within the table section it belongs to. If the row is not part of a section, returns -1.
 */
class HTMLTableRowElement extends HTMLElement
{
    public function __construct(string $value = "", string $uri = null)
    {
        parent::__construct("tr", $value, $uri);
    }

    /**
     * Removes the cell corresponding to index. If index is -1, the last cell of the row is removed. If index is less than -1 or greater than the amount of cells in the collection, a DOMException with the value IndexSizeError is raised.
     */
    public function deleteCell($index)
    {
        $children = $this->cells;
        $num_cells = $children->length;
        if ($index < -1 || $index >= $num_cells) {
            throw new DOMException(" The value provided ($index) is outside the range [0, $num_cells).");
        }

        if ($index == -1) {
            if ($num_cells == 0) {
                return;
            }
            $index = $num_cells - 1;
        }
        $children[$index]->remove();
    }

    /**
     * Returns an HTMLTableCellElement representing a new cell of the row. The cell is inserted in the collection of cells immediately before the given index position in the row. If index is -1, the new cell is appended to the collection. If index is less than -1 or greater than the number of cells in the collection, a DOMException with the value IndexSizeError is raised.
     */
    public function insertCell($index = -1): HTMLTableCellElement
    {
        $children = $this->cells;
        $num_cell = $children->length;

        if ($index < -1 || $index > $num_cell) {
            throw new DOMException("The value provided ($index) is outside the range [-1, $num_cell].");
        }

        $cell = $this->ownerDocument->createElement("td");
        if ($num_cell == $index || $index == -1) {
            $this->appendChild($cell);
        } else {
            $this->insertBefore($cell, $children[$index]);
        }

        return $cell;
    }


    public function __get($name)
    {
        if ($name === "cells") {
            $collection = new HTMLCollection();
            foreach ($this->childNodes as $element) {
                $collection->append($element);
            }
            return $collection;
        }

        if ($name === "rowIndex") {
            $table = $this->parentNode;
            if ($table instanceof HTMLTableElement) {
                $rows = $table->rows;
                for ($i = 0; $i < $rows->length; $i++) {
                    if ($rows[$i] === $this) {
                        return $i;
                    }
                }
            }
            return -1;
        }

        if ($name === "sectionRowIndex") {
            $table = $this->parentNode;
            if ($table instanceof HTMLTableElement) {
                $rows = $table->tBodies[0]->rows;
                for ($i = 0; $i < $rows->length; $i++) {
                    if ($rows[$i] === $this) {
                        return $i;
                    }
                }
            }
            return -1;
        }

        return parent::__get($name);
    }
}
