<?php

declare(strict_types=1);
error_reporting(E_ALL & ~E_WARNING);

use PHPUnit\Framework\TestCase;
use P\HTMLParagraphElement;

final class HTMLParagraphElementTest extends TestCase
{
    public function test_tag_name()
    {
        $p = new HTMLParagraphElement();
        $this->assertEquals("p", $p->tagName);
    }

    public function test_render_empty()
    {
        $p = new HTMLParagraphElement();
        $this->assertEquals("<p></p>", (string)$p);
    }

    public function test_render_with_content()
    {
        $p = new HTMLParagraphElement("paragraph text");
        $this->assertEquals("<p>paragraph text</p>", (string)$p);
    }
}
