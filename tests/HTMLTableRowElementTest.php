<?php
declare (strict_types = 1);
error_reporting(E_ALL & ~E_WARNING);
use PHPUnit\Framework\TestCase;
use P\HTMLTableRowElement;
use P\Document;

final class HTMLTableRowElementTest extends TestCase
{
    public function test_insertCell()
    {
        $doc = new Document();
        $t = $doc->createElement("table");
        $row = $t->insertRow();
        $cell = $row->insertCell();
        $this->assertEquals((string)$row, "<tr><td></td></tr>");


        $doc = new Document();
        $t = $doc->createElement("table");
        $row = $t->insertRow();
        $cell = $row->insertCell();
        $cell->textContent = "cell content";
        $this->assertEquals((string)$row, "<tr><td>cell content</td></tr>");
    }
}
