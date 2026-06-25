<?php

declare(strict_types=1);
error_reporting(E_ALL & ~E_WARNING);

use PHPUnit\Framework\TestCase;
use P\HTMLVideoElement;

final class HTMLVideoElementTest extends TestCase
{
    public function test_tag_name()
    {
        $video = new HTMLVideoElement();
        $this->assertEquals("video", $video->tagName);
    }

    public function test_autoplay_property()
    {
        $video = new HTMLVideoElement();
        $video->autoplay = true;
        $this->assertTrue($video->autoplay);
        $this->assertTrue($video->hasAttribute("autoplay"));
    }

    public function test_controls_property()
    {
        $video = new HTMLVideoElement();
        $video->controls = true;
        $this->assertTrue($video->controls);

        $video->controls = false;
        $this->assertFalse($video->controls);
    }

    public function test_render()
    {
        $video = new HTMLVideoElement();
        $video->controls = true;
        $this->assertEquals("<video controls></video>", (string)$video);
    }
}
