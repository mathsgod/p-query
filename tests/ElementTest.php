<?
declare (strict_types = 1);
error_reporting(E_ALL && ~E_WARNING);
use PHPUnit\Framework\TestCase;
use P\Element;

final class ElementTest extends TestCase
{
    const HTML = <<<HTML
<div class="container"><div class="hello">Hello</div><div class="goodbye">Goodbye</div></div>
HTML;

    public function testCreate()
    {
        $e = new P\Element("div");
        $this->assertInstanceOf(
            P\Element::class,
            $e
        );
    }

    public function testAddClass()
    {
        $e = new Element("div");
        $e->addClass("class1");
        $this->assertEquals('<div class="class1"></div>', $e->outerHTML);

    }

    public function testOuterHTML()
    {
        $e = new Element("div");
        $e->innerHTML = "<span>abc</span>";

        $this->assertEquals('<div><span>abc</span></div>', $e->outerHTML);
    }

    public function testInnerHTML()
    {
        $e = new Element("div");
        $e->innerHTML = "<span>abc</span>";
        $this->assertEquals("<span>abc</span>", $e->innerHTML);
    }

    public function testInnerText()
    {
        $e = new Element("div");
        $e->innerHTML = "<span>abc</span>";
        $this->assertEquals("abc", $e->innerText);

    }

    public function testBefore()
    {
        $parent = new Element("div");
        $child = new Element("p");
        $parent->appendChild($child);

        $span = new Element("span");
        $child->before($span);
        $this->assertEquals("<div><span></span><p></p></div>", $parent->outerHTML);

        //-----------------
        $parent = new Element("div");
        $child = new Element("p");
        $parent->appendChild($child);

        $child->before("Text");
        $this->assertEquals("<div>Text<p></p></div>", $parent->outerHTML);


    }
    public function testAfter()
    {
        $parent = new Element("div");
        $child = new Element("p");
        $parent->appendChild($child);

        $span = new Element("span");
        $child->after($span);
        $this->assertEquals("<div><p></p><span></span></div>", $parent->outerHTML);

        //-----------------
        $parent = new Element("div");
        $child = new Element("p");
        $parent->appendChild($child);

        $child->after("Text");
        $this->assertEquals("<div><p></p>Text</div>", $parent->outerHTML);
    }

    public function testReplaceWith(){
        $parent = new Element("div");
        $child = new Element("p");
        $parent->appendChild($child);

        $span = new Element("span");
        $child->replaceWith($span);
        $this->assertEquals("<div><span></span></div>", $parent->outerHTML);

    }

}