<?php

declare(strict_types=1);
error_reporting(E_ALL & ~E_WARNING);

use P\HTMLDivElement;
use PHPUnit\Framework\TestCase;


final class HTMLElementTest extends TestCase
{
    public function test_title()
    {
        $div = new HTMLDivElement();
        $div->title = "hello";

        $this->assertEquals("hello", $div->getAttribute("title"));
        $this->assertEquals("hello", $div->title);
    }
}
