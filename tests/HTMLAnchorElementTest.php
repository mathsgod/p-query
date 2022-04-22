<?php

declare(strict_types=1);
error_reporting(E_ALL & ~E_WARNING);

use P\HTMLAnchorElement;
use PHPUnit\Framework\TestCase;


final class HTMLAnchorElementTest extends TestCase
{

    function test_host()
    {
        $e = new HTMLAnchorElement();
        $e->href = "http://example.com/a/b.php";
        $this->assertEquals("example.com", $e->host);

        $e->host = "google.com";
        $this->assertEquals("http://google.com/a/b.php", $e->href);

        $e->host = "google.com:8080";
        $this->assertEquals("http://google.com:8080/a/b.php", $e->href);
    }

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
