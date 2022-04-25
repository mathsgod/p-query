<?php

declare(strict_types=1);
error_reporting(E_ALL & ~E_WARNING);

use P\HTMLTableElement;
use PHPUnit\Framework\TestCase;

final class HTMLTableRowElementTest extends TestCase
{
    public function test_insertCell()
    {
        $t = new HTMLTableElement();
        $row = $t->insertRow();
        $cell = $row->insertCell();
        $this->assertEquals((string)$row, "<tr><td></td></tr>");


        $t = new HTMLTableElement();
        $row = $t->insertRow();
        $cell = $row->insertCell();
        $cell->textContent = "cell content";
        $this->assertEquals((string)$row, "<tr><td>cell content</td></tr>");
    }
}
