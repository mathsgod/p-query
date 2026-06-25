<?php

declare(strict_types=1);
error_reporting(E_ALL & ~E_WARNING);

use PHPUnit\Framework\TestCase;
use P\HTMLAudioElement;

final class HTMLAudioElementTest extends TestCase
{
    public function test_tag_name()
    {
        $audio = new HTMLAudioElement();
        $this->assertEquals("audio", $audio->tagName);
    }

    public function test_autoplay_property()
    {
        $audio = new HTMLAudioElement();
        $audio->autoplay = true;
        $this->assertTrue($audio->autoplay);
        $this->assertTrue($audio->hasAttribute("autoplay"));

        $audio->autoplay = false;
        $this->assertFalse($audio->autoplay);
        $this->assertFalse($audio->hasAttribute("autoplay"));
    }

    public function test_controls_property()
    {
        $audio = new HTMLAudioElement();
        $audio->controls = true;
        $this->assertTrue($audio->controls);

        $audio->controls = false;
        $this->assertFalse($audio->controls);
    }

    public function test_render()
    {
        $audio = new HTMLAudioElement();
        $audio->autoplay = true;
        $this->assertEquals("<audio autoplay></audio>", (string)$audio);
    }
}
