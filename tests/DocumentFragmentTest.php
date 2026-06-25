<?php

declare(strict_types=1);
error_reporting(E_ALL & ~E_WARNING);

use PHPUnit\Framework\TestCase;
use P\Document;
use P\DocumentFragment;
use P\Element;

final class DocumentFragmentTest extends TestCase
{
    public function test_firstElementChild()
    {
        $fragment = Document::Current()->createDocumentFragment();
        $span = new Element("span");
        $fragment->appendChild($span);

        $this->assertEquals($span, $fragment->firstElementChild);
    }

    public function test_firstElementChild_with_text()
    {
        $fragment = Document::Current()->createDocumentFragment();
        $fragment->appendChild(new Element("span"));
        $p = new Element("p");
        $fragment->appendChild($p);

        $this->assertEquals("span", $fragment->firstElementChild->tagName);
    }

    public function test_append_and_render()
    {
        $fragment = Document::Current()->createDocumentFragment();
        $fragment->appendChild(new Element("span"));
        $fragment->appendChild(new Element("p"));

        $html = Document::Current()->saveHTML($fragment);
        $this->assertStringContainsString("<span></span>", $html);
        $this->assertStringContainsString("<p></p>", $html);
    }

    public function test_new_document_fragment_attached_to_current_document()
    {
        $fragment = new DocumentFragment();
        $this->assertInstanceOf(DocumentFragment::class, $fragment);
    }
}
