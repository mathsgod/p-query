<?php

declare(strict_types=1);
error_reporting(E_ALL & ~E_WARNING);

use P\HTMLDivElement;
use PHPUnit\Framework\TestCase;


final class HTMLElementTest extends TestCase
{
    function test_tabIndex()
    {
        $div = new HTMLDivElement();
        $this->assertEquals(-1, $div->tabIndex);
        $div->tabIndex = 1;
        $this->assertEquals(1, $div->tabIndex);
    }

    function test_contentEditable()
    {
        $div = new HTMLDivElement();
        $this->assertEquals("inherit", $div->contentEditable);
        $div->contentEditable = "true";
        $this->assertEquals("true", $div->contentEditable);
    }

    function test_hidden()
    {
        $div = new HTMLDivElement();
        $div->hidden = true;
        $this->assertTrue($div->hidden);
    }

    function test_title()
    {
        $div = new HTMLDivElement();
        $div->title = "hello";

        $this->assertEquals("hello", $div->getAttribute("title"));
        $this->assertEquals("hello", $div->title);
    }
}
