<?php

declare(strict_types=1);
error_reporting(E_ALL & ~E_WARNING);

use PHPUnit\Framework\TestCase;
use P\HTMLBRElement;

final class HTMLBRElementTest extends TestCase
{
    public function test_tag_name()
    {
        $br = new HTMLBRElement();
        $this->assertEquals("br", $br->tagName);
    }

    public function test_render()
    {
        $br = new HTMLBRElement();
        $this->assertEquals("<br>", (string)$br);
    }

    public function test_render_with_id()
    {
        $br = new HTMLBRElement();
        $br->id = "line1";
        $this->assertEquals("<br id=\"line1\">", (string)$br);
    }
}
