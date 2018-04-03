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

    public function testInnerText(){
        $e = new Element("div");
        $e->innerHTML = "<span>abc</span>";
        $this->assertEquals("abc", $e->innerText);
        
    }






}