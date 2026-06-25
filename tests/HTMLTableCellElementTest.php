<?php

declare(strict_types=1);
error_reporting(E_ALL & ~E_WARNING);

use PHPUnit\Framework\TestCase;
use P\Document;
use P\HTMLTableCellElement;

final class HTMLTableCellElementTest extends TestCase
{
    public function test_create_td()
    {
        $doc = new Document();
        $cell = $doc->createElement("td");
        $this->assertInstanceOf(HTMLTableCellElement::class, $cell);
        $this->assertEquals("td", $cell->tagName);
    }

    public function test_create_th()
    {
        $doc = new Document();
        $cell = $doc->createElement("th");
        $this->assertInstanceOf(HTMLTableCellElement::class, $cell);
        $this->assertEquals("th", $cell->tagName);
    }

    public function test_render()
    {
        $doc = new Document();
        $cell = $doc->createElement("td");
        $cell->textContent = "data";
        $this->assertEquals("<td>data</td>", (string)$cell);
    }
}
