<?php

declare(strict_types=1);
error_reporting(E_ALL & ~E_WARNING);

use PHPUnit\Framework\TestCase;
use P\Document;
use P\HTMLDivElement;

final class CSSStyleDeclarationTest extends TestCase
{

    public function test_css()
    {
        $div = new HTMLDivElement();

        $div->style->backgroundColor = "red";
        $div->style->color = "blue";
        $this->assertEquals(2, $div->style->length);

        $div->style->removeProperty("background-color");
        $this->assertEquals(1, $div->style->length);


        $this->assertEquals("blue", $div->style->getPropertyValue("color"));
    }

    public function test_cssText()
    {
        $doc = new Document();
        $div = $doc->createElement("div", "hello");
        $div->style->backgroundColor = "red";

        $this->assertEquals('background-color: red', $div->style->cssText);

        $div->style->color = "green";

        $this->assertEquals('background-color: red; color: green', $div->style->cssText);
    }

    function test_setProperty()
    {
        $div = new HTMLDivElement();
        $div->style->setProperty("background-color", "red");
        $this->assertEquals("red", $div->style->backgroundColor);
    }

    function test_removeProperty()
    {
        $div = new HTMLDivElement();
        $div->style->backgroundColor = "red";
        $div->style->removeProperty("background-color");
        $this->assertEquals("", $div->style->backgroundColor);
    }
}
