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

        $doc = new Document();
        $t = $doc->createElement("table");
        $h = $t->createTHead();

        $this->assertInstanceOf(P\Element::class, $h);
        $this->assertEquals("<table><thead></thead></table>", $t->outerHTML);

        $bhody = $t->createTHead();
        $this->assertInstanceOf(P\Element::class, $h);
        $this->assertEquals("<table><thead></thead></table>", $t->outerHTML);
    }

    public function test_createTBody()
    {
        $doc = new Document();
        $t = $doc->createElement("table");
        $body = $t->createTBody();

        $this->assertInstanceOf(P\Element::class, $body);
        $this->assertEquals("<table><tbody></tbody></table>", str_replace("\n", "", (string)$t));

        $body = $t->createTBody();
        $this->assertInstanceOf(P\Element::class, $body);
        $this->assertEquals("<table><tbody></tbody><tbody></tbody></table>", str_replace("\n", "", (string)$t));
    }

    public function test_createTFoot()
    {
        $doc = new Document();
        $t = $doc->createElement("table");

        $f = $t->createTFoot();

        $this->assertInstanceOf(P\Element::class, $f);
        $this->assertEquals("<table><tfoot></tfoot></table>", $t->outerHTML);
    }

    public function test_insertRow()
    {
        $doc = new Document();
        $t = $doc->createElement("table");

        $r = $t->insertRow();

        $this->assertInstanceOf(P\Element::class, $r);

        $this->assertEquals("<table><tbody><tr></tr></tbody></table>", $t->outerHTML);
    }

    public function test_insertCell()
    {
        $doc = new Document();
        $t = $doc->createElement("table");
        $r = $t->insertRow();
        $cell = $r->insertCell();
        $cell = $r->insertCell();
        $cell->textContent = "hello";

        $r = $t->insertRow();
        $cell = $r->insertCell();
        $cell = $r->insertCell();
        $cell->textContent = "hello";

        $this->assertEquals("<table><tbody><tr><td></td><td>hello</td></tr><tr><td></td><td>hello</td></tr></tbody></table>", str_replace("\n", "", (string)$t));
    }
}
