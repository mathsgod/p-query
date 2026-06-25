<?php

declare(strict_types=1);
error_reporting(E_ALL & ~E_WARNING);

use PHPUnit\Framework\TestCase;
use P\HTMLOptGroupElement;
use P\HTMLOptionElement;

final class HTMLOptGroupElementTest extends TestCase
{
    public function test_tag_name()
    {
        $group = new HTMLOptGroupElement();
        $this->assertEquals("optgroup", $group->tagName);
    }

    public function test_label_property()
    {
        $group = new HTMLOptGroupElement();
        $group->label = "Group A";
        $this->assertEquals("Group A", $group->label);
        $this->assertEquals("Group A", $group->getAttribute("label"));
    }

    public function test_disabled_all_children()
    {
        $group = new HTMLOptGroupElement();
        $opt1 = new HTMLOptionElement();
        $opt2 = new HTMLOptionElement();
        $group->appendChild($opt1);
        $group->appendChild($opt2);

        $group->disabled = true;
        $this->assertTrue($group->disabled);
        $this->assertTrue($opt1->disabled);
        $this->assertTrue($opt2->disabled);
    }

    public function test_disabled_partial_children()
    {
        $group = new HTMLOptGroupElement();
        $opt1 = new HTMLOptionElement();
        $opt2 = new HTMLOptionElement();
        $group->appendChild($opt1);
        $group->appendChild($opt2);

        $opt2->disabled = true;
        $this->assertFalse($group->disabled);
    }
}
