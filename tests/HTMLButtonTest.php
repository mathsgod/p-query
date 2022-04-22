<?php

declare(strict_types=1);
error_reporting(E_ALL & ~E_WARNING);

use P\HTMLButtonElement;
use PHPUnit\Framework\TestCase;

final class HTMLButtonElementTest extends TestCase
{
    public function test_autofocus()
    {
        $e = new HTMLButtonElement();
        $e->autofocus = true;
        $this->assertEquals("", $e->getAttribute("autofocus"));
        $e->autofocus = false;
        $this->assertEquals("", $e->getAttribute("autofocus"));
    }

    public function test_disabled()
    {
        $e = new HTMLButtonElement();
        $e->disabled = true;
        $this->assertEquals("", $e->getAttribute("disabled"));
        $e->disabled = false;
        $this->assertEquals("", $e->getAttribute("disabled"));
    }

    public function test_name()
    {
        $e = new HTMLButtonElement();
        $e->name = "foo";
        $this->assertEquals("foo", $e->getAttribute("name"));
        $e->name = "";
        $this->assertEquals("", $e->getAttribute("name"));
    }

    public function test_type()
    {
        $e = new HTMLButtonElement();
        $e->type = "submit";
        $this->assertEquals("submit", $e->getAttribute("type"));
        $e->type = "reset";
        $this->assertEquals("reset", $e->getAttribute("type"));
        $e->type = "button";
        $this->assertEquals("button", $e->getAttribute("type"));
        $e->type = "menu";
        $this->assertEquals("menu", $e->getAttribute("type"));
    }

    public function test_value()
    {
        $e = new HTMLButtonElement();
        $e->value = "foo";
        $this->assertEquals("foo", $e->getAttribute("value"));
        $e->value = "";
        $this->assertEquals("", $e->getAttribute("value"));
    }
}
