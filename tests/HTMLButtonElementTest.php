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
        $this->assertTrue($e->autofocus);
        $e->autofocus = false;
        //$this->assertNull($e->getAttribute("autofocus"));
        $this->assertFalse($e->autofocus);
    }

    public function test_disabled()
    {
        $e = new HTMLButtonElement();
        $e->disabled = true;
        $this->assertEquals("", $e->getAttribute("disabled"));
        $this->assertTrue($e->disabled);
        $e->disabled = false;
        //$this->assertNull($e->getAttribute("disabled"));
        $this->assertFalse($e->disabled);
    }

    public function test_name()
    {
        $e = new HTMLButtonElement();
        $e->name = "foo";
        $this->assertEquals("foo", $e->getAttribute("name"));
        $this->assertEquals("foo", $e->name);
        $e->name = "";
        $this->assertEquals("", $e->getAttribute("name"));
        $this->assertEquals("", $e->name);
    }

    public function test_type()
    {
        $e = new HTMLButtonElement();
        $e->type = "submit";
        $this->assertEquals("submit", $e->getAttribute("type"));
        $this->assertEquals("submit", $e->type);
        $e->type = "reset";
        $this->assertEquals("reset", $e->getAttribute("type"));
        $this->assertEquals("reset", $e->type);
        $e->type = "button";
        $this->assertEquals("button", $e->getAttribute("type"));
        $this->assertEquals("button", $e->type);
        $e->type = "menu";
        $this->assertEquals("menu", $e->getAttribute("type"));
        $this->assertEquals("menu", $e->type);
    }

    public function test_value()
    {
        $e = new HTMLButtonElement();
        $e->value = "foo";
        $this->assertEquals("foo", $e->getAttribute("value"));
        $this->assertEquals("foo", $e->value);
        $e->value = "";
        $this->assertEquals("", $e->getAttribute("value"));
        $this->assertEquals("", $e->value);
    }
}
