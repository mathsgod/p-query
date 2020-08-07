<?php

declare(strict_types=1);
error_reporting(E_ALL && ~E_WARNING);

use PHPUnit\Framework\TestCase;
use P\Element;
use P\Document;
use P\Event;

final class ElementTest extends TestCase
{

    const HTML = <<<HTML
<div class="container"><div class="hello">Hello</div><div class="goodbye">Goodbye</div></div>
HTML;
    public $doc;
    public function __construct()
    {
        parent::__construct();
        $this->doc = Document::Current();
    }

    public function test_closest()
    {
        $e = p("<div><span id='span1'>abc</span></div>");

        $span = $e->find("#span1")[0];

        $this->assertEquals($e[0], $span->closest("div"));

        $this->assertNull($span->closest('body'));
    }

    public function test_style()
    {
        $doc = new Document();
        $div = $doc->createElement("div", "hello");
        $div->style->backgroundColor = "red";
        $this->assertEquals('<div style="background-color: red">hello</div>', (string)$div);
    }

    public function test_setAttribute()
    {
        $doc = new Document();
        $div = $doc->createElement("div", "hello");
        $div->setAttribute("a1", "abc");
        $this->assertEquals('<div a1="abc">hello</div>', (string)$div);


        $doc = new Document();
        $div = $doc->createElement("div", "hello");
        $div->setAttribute("a1", "");
        $this->assertEquals('<div a1>hello</div>', (string)$div);
    }

    public function test_element_encoding()
    {
        $doc = new Document();
        $element = $doc->createElement("div", "一二三");

        $this->assertEquals("<div>一二三</div>", (string)$element);
    }


    /*    public function test_getElementById()
    {
        $div = p("<div><p><div id='div1'> <span>abc</span></div> </p> <p> <span>xxx</span></p></div>")[0];
        $d=$div->getElementById('div1');
        $this->assertEquals('<div id="div1"> <span>abc</span></div>', (string)$d);

    }*/
    /*public function test_querySelectorAll()
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
    }*/

    public function testCreate()
    {

        $e = $this->doc->createElement("div");
        $this->assertInstanceOf(
            P\Element::class,
            $e
        );
    }

    /*    public function testAddClass()
    {
        $e = new Element("div");
        $e->addClass("class1");
        $this->assertEquals('<div class="class1"></div>', $e->outerHTML);
    }
*/
    public function testOuterHTML()
    {
        $e = p("<div><span>abc</span></div>")[0];
        //        $e->innerHTML = "<span>abc</span>";

        $this->assertEquals('<div><span>abc</span></div>', str_replace("\n", "", $e->outerHTML));

        $e =  p("div")[0];
        $e->innerHTML .= "<br>abc";
        $e->innerHTML .= "<br>xyz";
        $this->assertEquals("<div><br>abc<br>xyz</div>",  str_replace("\n", "", $e->outerHTML));

        $div = p("<div><span>一二三</span></div>")[0];

        $this->assertEquals("<div><span>一二三</span></div>",  str_replace("\n", "", $div));
    }

    public function testInnerHTML()
    {
        $e = $this->doc->createElement("div");
        $e->innerHTML = "<span>abc</span>";
        $this->assertEquals("<span>abc</span>", $e->innerHTML);

        $e =  $this->doc->createElement("div");
        $e->innerHTML .= "<br/>abc";
        $e->innerHTML .= "<br/>xyz";
        $this->assertEquals("<br>abc<br>xyz", $e->innerHTML);
    }

    public function testInnerText()
    {
        $e =  $this->doc->createElement("div");
        $e->innerHTML = "<span>abc</span>";
        $this->assertEquals("abc", $e->innerText);

        $e =  $this->doc->createElement("div");
        $e->innerText = "<p>abc</p>";
        $this->assertEquals("<div>&lt;p&gt;abc&lt;/p&gt;</div>", (string)$e);
    }

    public function testBefore()
    {
        $parent = $this->doc->createElement("div");
        $child =  $this->doc->createElement("p");
        $parent->appendChild($child);

        $span =  $this->doc->createElement("span");
        $child->before($span);
        $this->assertEquals("<div><span></span><p></p></div>",  str_replace("\n", "", $parent));

        //-----------------
        $parent =  $this->doc->createElement("div");
        $child =  $this->doc->createElement("p");
        $parent->appendChild($child);

        $child->before("Text");
        $this->assertEquals("<div>Text<p></p></div>", str_replace("\n", "", $parent));
    }
    public function testAfter()
    {
        $parent = $this->doc->createElement("div");
        $child =  $this->doc->createElement("p");
        $parent->appendChild($child);

        $span =  $this->doc->createElement("span");
        $child->after($span);
        $this->assertEquals("<div><p></p><span></span></div>", str_replace("\n", "", $parent));

        //-----------------
        $parent =  $this->doc->createElement("div");;
        $child = $this->doc->createElement("p");
        $parent->appendChild($child);

        $child->after("Text");
        $this->assertEquals("<div><p></p>Text</div>", str_replace("\n", "", $parent));
    }

    public function testReplaceWith()
    {
        $parent = $this->doc->createElement("div");
        $child = $this->doc->createElement("p");
        $parent->appendChild($child);

        $span = $this->doc->createElement("span");
        $child->replaceWith($span);
        $this->assertEquals("<div><span></span></div>", str_replace("\n", "", $parent));
    }

    public function test_children()
    {
        $div =  $this->doc->createElement("div");

        $p =  $this->doc->createElement("p");
        $div->appendChild($p);
        //$div->append("test");
        $this->assertEquals($div->children[0], $p);
    }

    public function text_querySelectorAll()
    {
        $doc = new Document();
        $div = $doc->createElement("div");
        $div->innerHTML = "<span class='abc'>abc<span>";

        $this->assertEquals($div->querySelectorAll("span.abc")->length, 1);
    }

    public function test_matches()
    {
        $div =  $this->doc->createElement("div");
        $div->innerHTML = "<span>abc</span>";

        $this->assertTrue($div->matches("div"));

        $div->setAttribute("id", "id1");
        $this->assertTrue($div->matches("#id1"));
    }

    public function test_prepend()
    {
        $div =  $this->doc->createElement("div");
        $div->innerHTML = "<span>abc</span>";

        $p = $this->doc->createElement("p");

        $div->prepend($p);

        $this->assertEquals("<div><p></p><span>abc</span></div>", str_replace("\n", "", $div));
    }

    public function test_classList()
    {
        $div = p("<div class='c1 c2'>abc</div>")[0];

        $div->classList->add("abc");
        $this->assertEquals('<div class="c1 c2 abc">abc</div>', (string)$div);

        $div = p("<div class='c1 c2'>abc</div>")[0];
        $div->classList->add("abc", "def");
        $this->assertEquals('<div class="c1 c2 abc def">abc</div>', (string)$div);

        $div = p("<div class='c1 c2 c3'>abc</div>")[0];
        $div->classList->remove("c1", "c2");
        $this->assertEquals('<div class="c3">abc</div>', (string)$div);

        $div = p("<div class='c1 c2 c3'>abc</div>")[0];
        $this->assertTrue($div->classList->contains("c1"));

        $div = p("<div class='c1 c2 c3'>abc</div>")[0];
        $div->classList->toggle("c2");
        $this->assertEquals('<div class="c1 c3">abc</div>', (string)$div);
        $div->classList->toggle("c2");
        $this->assertEquals('<div class="c1 c3 c2">abc</div>', (string)$div);


        $div = p("<div class='c1 c2 c3'>abc</div>")[0];
        $this->assertEquals($div->classList->length, 3);

        $div = p("<div class='c1 c2 c3'>abc</div>")[0];
        $div->classList[] = "c4";
        $this->assertEquals($div->classList->length, 4);
    }

    public function test_remove()
    {
        $div = p("<div><span>a<p>b</p>c<p>d</p></span></div>")[0];
        $div->querySelector('span')->remove();
        $this->assertEquals("<div></div>", (string)$div);
    }

    public function test_addEvent()
    {
        $input = p("<input value='a'/>")[0];
        $input->addEventListener('update', function ($e) {
            $this->assertEquals($e->type, "update");
        });

        $input->dispatchEvent(new Event('update'));
    }
}
