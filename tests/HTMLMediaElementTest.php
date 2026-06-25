<?php

declare(strict_types=1);
error_reporting(E_ALL & ~E_WARNING);

use PHPUnit\Framework\TestCase;
use P\HTMLMediaElement;

final class HTMLMediaElementTest extends TestCase
{
    public function test_autoplay_set_true()
    {
        $media = new HTMLMediaElement("audio");
        $media->autoplay = true;
        $this->assertTrue($media->autoplay);
        $this->assertTrue($media->hasAttribute("autoplay"));
    }

    public function test_autoplay_set_false()
    {
        $media = new HTMLMediaElement("audio");
        $media->autoplay = true;
        $media->autoplay = false;
        $this->assertFalse($media->autoplay);
        $this->assertFalse($media->hasAttribute("autoplay"));
    }

    public function test_controls_set_true()
    {
        $media = new HTMLMediaElement("video");
        $media->controls = true;
        $this->assertTrue($media->controls);
    }

    public function test_controls_set_false()
    {
        $media = new HTMLMediaElement("video");
        $media->controls = true;
        $media->controls = false;
        $this->assertFalse($media->controls);
    }

    public function test_other_property_passthrough()
    {
        $media = new HTMLMediaElement("audio");
        $media->id = "myAudio";
        $this->assertEquals("myAudio", $media->id);
    }
}
