<?php
namespace P;

class HTMLTableRowElement extends HTMLElement
{
    public function __construct()
    {
        parent::__construct("tr");
    }

    public function insertCell($index = -1)
    {
        $children = $this->cells;
        $num_cell = $children->length;

        if ($index < -1 || $index > $num_cell) {
            throw new DOMException("The value provided ($index) is outside the range [-1, $num_cell].");
        }

        $cell = new HTMLTableCellElement();
        if ($num_cells == $index || $index == -1) {
            $this->appendChild($cell);
        } else {
            $this->insertBefore($cell, $children[$index]);
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
                foreach ($this->children as $child) {
                    $collection[] = $child;
                }
                return $collection;
                break;
        }
        return parent::__get($name);
    }
}