<?php
namespace P;

class HTMLTableSectionElement extends HTMLElement
{
    public function insertRow(): HTMLTableRowElement
    {
        $row = $this->ownerDocument->createElement("tr");
        $this->appendChild($row);
        return $row;
    }

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
}
