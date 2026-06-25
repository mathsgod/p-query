<?php

declare(strict_types=1);
error_reporting(E_ALL & ~E_WARNING);

use PHPUnit\Framework\TestCase;
use P\HTMLDataListElement;
use P\HTMLOptionElement;

final class HTMLDataListElementTest extends TestCase
{
    public function test_tag_name()
    {
        $datalist = new HTMLDataListElement();
        $this->assertEquals("datalist", $datalist->tagName);
    }

    public function test_options_collection()
    {
        $datalist = new HTMLDataListElement();
        $datalist->appendChild(new HTMLOptionElement());
        $datalist->appendChild(new HTMLOptionElement());

        $options = $datalist->options;
        $this->assertEquals(2, $options->length);
        $this->assertEquals("option", $options->item(0)->tagName);
    }

    public function test_empty_options()
    {
        $datalist = new HTMLDataListElement();
        $this->assertEquals(0, $datalist->options->length);
    }
}
