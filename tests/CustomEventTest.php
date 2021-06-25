<?php

declare(strict_types=1);
error_reporting(E_ALL & ~E_WARNING);

use P\CustomEvent;
use PHPUnit\Framework\TestCase;
use P\HTMLElement;

final class CustomEventTest extends TestCase
{
    public function test_dispatchEvent()
    {
        $div = new HTMLElement("div");

        $event = new CustomEvent("cat", ["detail" => [
            "hello" => "world"
        ]]);

        $div->addEventListener("cat", function ($e) {
            $this->assertEquals("world", $e->detail["hello"]);
        });

        $div->dispatchEvent($event);
    }
}
