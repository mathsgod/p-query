<?php

declare(strict_types=1);
error_reporting(E_ALL & ~E_WARNING);

use PHPUnit\Framework\TestCase;
use P\DocumentFragment;
use P\Element;
use P\HTMLTemplateElement;

final class HTMLTemplateElementTest extends TestCase
{
    public function test_tag_name()
    {
        $template = new HTMLTemplateElement();
        $this->assertEquals("template", $template->tagName);
    }

    public function test_content_is_document_fragment()
    {
        $template = new HTMLTemplateElement();
        $span = new Element("span");
        $template->appendChild($span);

        $content = $template->content;
        $this->assertInstanceOf(DocumentFragment::class, $content);
        $this->assertEquals(1, $content->childNodes->length);
    }

    public function test_content_moves_children()
    {
        $template = new HTMLTemplateElement();
        $template->innerHTML = "<p>hello</p>";

        $content = $template->content;
        $this->assertEquals(1, $content->childNodes->length);
        $this->assertEquals("p", $content->firstElementChild->tagName);
        $this->assertEquals("hello", $content->firstElementChild->textContent);
    }
}
