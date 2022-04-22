<?php

declare(strict_types=1);
error_reporting(E_ALL & ~E_WARNING);

use P\HTMLAreaElement;
use PHPUnit\Framework\TestCase;

final class HTMLAreaElementTest extends TestCase
{
    public function test_hostname()
    {
        $a = new HTMLAreaElement();
        $a->href = "https://www.google.com/a/b.php";
        $this->assertEquals("www.google.com", $a->hostname);

        $a->hostname = "www.example.com";

        $this->assertEquals("https://www.example.com/a/b.php", $a->href);
    }
}
