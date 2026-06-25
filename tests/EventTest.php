<?php

declare(strict_types=1);
error_reporting(E_ALL & ~E_WARNING);

use PHPUnit\Framework\TestCase;
use P\Event;

final class EventTest extends TestCase
{
    public function test_type()
    {
        $event = new Event("click");
        $this->assertEquals("click", $event->type);
    }

    public function test_custom_type()
    {
        $event = new Event("custom-update");
        $this->assertEquals("custom-update", $event->type);
    }
}
