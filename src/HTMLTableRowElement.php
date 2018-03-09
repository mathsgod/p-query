<?php
namespace P;
class HTMLTableRowElement extends HTMLElement {
    public function __construct() {
        parent::__construct("tr");
    }

    public function insertCell($index = - 1) {
        $cell = new HTMLTableCellElement();
        $this->appendChild($cell);
        return $cell;
    }
}

?>