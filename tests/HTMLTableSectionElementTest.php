<?php

declare(strict_types=1);
error_reporting(E_ALL & ~E_WARNING);

use P\HTMLTableElement;
use PHPUnit\Framework\TestCase;


class HTMLTableSectionElementTest extends TestCase
{
    public function test_insertRow()
    {
        $table = new HTMLTableElement();
        $body = $table->createTBody();
        $row = $body->insertRow();
        $this->assertEquals((string)$row, "<tr></tr>");
    }

    public function test_deleteRow()
    {
        $table = new HTMLTableElement();
        $body = $table->createTBody();
        $row = $body->insertRow();
        $this->assertEquals((string)$row, "<tr></tr>");

        $body->deleteRow(-1);
        $this->assertEquals((string)$row, "<tr></tr>");


        $this->expectException(DOMException::class);
        $body->deleteRow(0);
        $this->assertEquals((string)$row, "");
    }
}
