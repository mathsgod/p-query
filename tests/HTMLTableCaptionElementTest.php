<?php

declare(strict_types=1);
error_reporting(E_ALL & ~E_WARNING);

use PHPUnit\Framework\TestCase;
use P\HTMLTableCaptionElement;

final class HTMLTableCaptionElementTest extends TestCase
{
    public function test_tag_name()
    {
        $caption = new HTMLTableCaptionElement();
        $this->assertEquals("caption", $caption->tagName);
    }

    public function test_render_empty()
    {
        $caption = new HTMLTableCaptionElement();
        $this->assertEquals("<caption></caption>", (string)$caption);
    }

    public function test_render_with_content()
    {
        $caption = new HTMLTableCaptionElement("Table 1");
        $this->assertEquals("<caption>Table 1</caption>", (string)$caption);
    }
}
