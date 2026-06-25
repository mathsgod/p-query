<?php

declare(strict_types=1);
error_reporting(E_ALL & ~E_WARNING);

use PHPUnit\Framework\TestCase;
use P\HTMLSpanElement;

final class HTMLSpanElementTest extends TestCase
{
    public function test_tag_name()
    {
        $span = new HTMLSpanElement();
        $this->assertEquals("span", $span->tagName);
    }

    public function test_render_empty()
    {
        $span = new HTMLSpanElement();
        $this->assertEquals("<span></span>", (string)$span);
    }

    public function test_render_with_content()
    {
        $span = new HTMLSpanElement("inline text");
        $this->assertEquals("<span>inline text</span>", (string)$span);
    }
}
