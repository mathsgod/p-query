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

    public function test_getElementById()
    {
        $div = p("<div><p><div id='div1'> <span>abc</span></div> </p> <p> <span>xxx</span></p></div>")[0];
        $d=$div->getElementById('div1');
        $this->assertEquals('<div id="div1"> <span>abc</span></div>', (string)$d);

    }
    public function test_querySelectorAll()
    {
        $div = p(self::HTML)[0];
        $str = "";
        foreach ($div->querySelectorAll("div") as $a) {
            $str .= (string)$a;
        }
        $this->assertEquals('<div class="hello">Hello</div><div class="goodbye">Goodbye</div>', $str);


        $str = "";
        $div = p("<div><p><div> <span>abc</span></div> </p> <p> <span>xxx</span></p></div>")[0];
        foreach ($div->querySelectorAll("p span") as $a) {
            $str .= (string)$a;
        }
        $this->assertEquals('<span>abc</span><span>xxx</span>', $str);
    }

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

        $e = new Element("div");
        $e->innerHTML .= "<br/>abc";
        $e->innerHTML .= "<br/>xyz";
        $this->assertEquals("<div><br/>abc<br/>xyz</div>", $e->outerHTML);
    }

    public function testInnerHTML()
    {
        $e = new Element("div");
        $e->innerHTML = "<span>abc</span>";
        $this->assertEquals("<span>abc</span>", $e->innerHTML);

        $e = new Element("div");
        $e->innerHTML .= "<br/>abc";
        $e->innerHTML .= "<br/>xyz";
        $this->assertEquals("<br/>abc<br/>xyz", $e->innerHTML);
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

    public function testReplaceWith()
    {
        $parent = new Element("div");
        $child = new Element("p");
        $parent->appendChild($child);

        $span = new Element("span");
        $child->replaceWith($span);
        $this->assertEquals("<div><span></span></div>", $parent->outerHTML);
    }

    public function test_children()
    {
        $div = new Element("div");

        $p = new Element("p");
        $div->appendChild($p);
        //$div->append("test");


        $this->assertEquals($div->children[0], $p);
    }
}
