<?php

declare(strict_types=1);
error_reporting(E_ALL & ~E_WARNING);

use PHPUnit\Framework\TestCase;
use P\HTMLDivElement;

final class HTMLDivElementTest extends TestCase
{
    public function test_tag_name()
    {
        $div = new HTMLDivElement();
        $this->assertEquals("div", $div->tagName);
    }

    public function test_render_empty()
    {
        $div = new HTMLDivElement();
        $this->assertEquals("<div></div>", (string)$div);
    }

    public function test_render_with_content()
    {
        $div = new HTMLDivElement("hello");
        $this->assertEquals("<div>hello</div>", (string)$div);
    }

    public function test_class_and_style()
    {
        $div = new HTMLDivElement();
        $div->className = "box";
        $div->style->backgroundColor = "red";

        $this->assertEquals("<div class=\"box\" style=\"background-color: red\"></div>", (string)$div);
    }
}
