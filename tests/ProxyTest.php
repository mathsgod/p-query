<?php

declare(strict_types=1);
error_reporting(E_ALL & ~E_WARNING);

use PHPUnit\Framework\TestCase;
use P\Proxy;

final class ProxyTest extends TestCase
{
    public function test_get_handler()
    {
        $target = new stdClass();
        $proxy = new Proxy($target, [
            "get" => function ($target, $name) {
                return "got_" . $name;
            }
        ]);

        $this->assertEquals("got_foo", $proxy->foo);
    }

    public function test_set_handler()
    {
        $target = new stdClass();
        $proxy = new Proxy($target, [
            "set" => function ($target, $name, $value) {
                $target->{$name} = "set_" . $value;
            }
        ]);

        $proxy->bar = "value";
        $this->assertEquals("set_value", $target->bar);
    }

    public function test_no_handler()
    {
        $target = new stdClass();
        $target->baz = "original";
        $proxy = new Proxy($target, []);

        $this->assertNull($proxy->baz);
    }
}
