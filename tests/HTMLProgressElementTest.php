<?php

declare(strict_types=1);
error_reporting(E_ALL & ~E_WARNING);

use PHPUnit\Framework\TestCase;
use P\HTMLProgressElement;

final class HTMLProgressElementTest extends TestCase
{
    public function test_tag_name()
    {
        $progress = new HTMLProgressElement();
        $this->assertEquals("progress", $progress->tagName);
    }

    public function test_max_value()
    {
        $progress = new HTMLProgressElement();
        $progress->max = 100;
        $progress->value = 50;

        $this->assertEquals(100.0, $progress->max);
        $this->assertEquals(50.0, $progress->value);
    }

    public function test_position()
    {
        $progress = new HTMLProgressElement();
        $progress->max = 100;
        $progress->setAttribute("position", "25");

        $this->assertEquals(0.25, $progress->position);
    }

    public function test_render()
    {
        $progress = new HTMLProgressElement();
        $progress->max = 100;
        $progress->value = 75;

        $this->assertEquals("<progress max=\"100\" value=\"75\"></progress>", (string)$progress);
    }

    public function test_progress_alias()
    {
        $this->assertTrue(class_exists('P\ProgressElement'));
        $this->assertInstanceOf(HTMLProgressElement::class, new \P\ProgressElement());
    }
}
