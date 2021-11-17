<?php

declare(strict_types=1);
error_reporting(E_ALL & ~E_WARNING);

use PHPUnit\Framework\TestCase;
use P\Document;
use P\HTMLTableCaptionElement;
use P\HTMLTableElement;

final class HTMLTableElementTest extends TestCase
{
    const HTML = <<<HTML
<table></table>
HTML;


    function test_caption()
    {
        $table = new HTMLTableElement();
        $table->caption = new HTMLTableCaptionElement("test");

        $this->assertEquals(
            "<table><caption>test</caption></table>",
            $table->outerHTML
        );
    }

    public function test_createTHead()
    {
        $table = new HTMLTableElement();
        $h = $table->createTHead();

        $this->assertEquals("<table><thead></thead></table>", $table->outerHTML);

        $bhody = $table->createTBody();
        $this->assertEquals("<table><thead></thead><tbody></tbody></table>", $table->outerHTML);
    }

    public function test_createTBody()
    {
        $table = new HTMLTableElement();
        $table->createTBody();

        $this->assertEquals("<table><tbody></tbody></table>", $table->outerHTML);

        $table->createTBody();
        $this->assertEquals("<table><tbody></tbody><tbody></tbody></table>", $table->outerHTML);
    }

    public function test_createTFoot()
    {
        $table = new HTMLTableElement();
        $table->createTFoot();

        $this->assertEquals("<table><tfoot></tfoot></table>", $table->outerHTML);
    }

    public function test_insertRow()
    {
        $table = new HTMLTableElement();
        $r = $table->insertRow();
        $this->assertEquals("<table><tbody><tr></tr></tbody></table>", $table->outerHTML);
    }

    public function test_insertCell()
    {
        $table = new HTMLTableElement();
        $r = $table->insertRow();
        $cell = $r->insertCell();
        $cell = $r->insertCell();
        $cell->textContent = "hello";

        $r = $table->insertRow();
        $cell = $r->insertCell();
        $cell = $r->insertCell();
        $cell->textContent = "hello";

        $this->assertEquals("<table><tbody><tr><td></td><td>hello</td></tr><tr><td></td><td>hello</td></tr></tbody></table>", $table->outerHTML);
    }
}
