<?php

declare(strict_types=1);
error_reporting(E_ALL & ~E_WARNING);

use P\HTMLAnchorElement;
use PHPUnit\Framework\TestCase;


final class HTMLAnchorElementTest extends TestCase
{
    function test_pathname()
    {
        $a = new HTMLAnchorElement();
        $a->href = "https://www.google.com/a/b.php";
        $this->assertEquals("/a/b.php", $a->pathname);
    }

    function test_href()
    {
        $a = new HTMLAnchorElement();
        $a->href = "https://www.google.com";
        $this->assertEquals("https://www.google.com", $a->href);
    }

    function test_hostname()
    {
        $a = new HTMLAnchorElement();
        $a->href = "https://www.google.com/a/b.php";
        $this->assertEquals("www.google.com", $a->hostname);
    }
}
