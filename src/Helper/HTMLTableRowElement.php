<?

namespace P\Helper;

use \DOMException;
use \P\HTMLCollection;

class HTMLTableRowElement extends Element
{
    public function insertCell($index = -1)
    {
        $children = $this->cells;
        $num_cell = $children->length;

        if ($index < -1 || $index > $num_cell) {
            throw new DOMException("The value provided ($index) is outside the range [-1, $num_cell].");
        }

        $cell = $this->element->ownerDocument->createElement("td");
        if ($num_cell == $index || $index == -1) {
            $this->element->appendChild($cell);
        } else {
            $this->element->insertBefore($cell, $children[$index]);
        }

        return $cell;
    }

    public function deleteCell($index = -1)
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

    public function __get($name)
    {
        switch ($name) {
            case "cells":
                $collection = new HTMLCollection();
                foreach ($this->element->childNodes as $node) {
                    $collection[] = $node;
                }
                return $collection;
                break;
        }
        return parent::__get($name);
    }
}
