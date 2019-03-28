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
    public $doc;
    public function __construct()
    {
        parent::__construct();
        $this->doc = new P\Document;
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
        $e =  $this->doc->createElement("div");
        $e->innerHTML = "<span>abc</span>";

        $this->assertEquals('<div><span>abc</span></div>', $e->outerHTML);

        $e =  $this->doc->createElement("div");
        $e->innerHTML .= "<br/>abc";
        $e->innerHTML .= "<br/>xyz";
        $this->assertEquals("<div><br>abc<br>xyz</div>", $e->outerHTML);
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
        $e->innerText="<p>abc</p>";
        $this->assertEquals("<div>&lt;p&gt;abc&lt;/p&gt;</div>",(string)$e);

    }

    public function testBefore()
    {
        $parent = $this->doc->createElement("div");
        $child =  $this->doc->createElement("p");
        $parent->appendChild($child);

        $span =  $this->doc->createElement("span");
        $child->before($span);
        $this->assertEquals("<div><span></span><p></p></div>", $parent->outerHTML);

        //-----------------
        $parent =  $this->doc->createElement("div");
        $child =  $this->doc->createElement("p");
        $parent->appendChild($child);

        $child->before("Text");
        $this->assertEquals("<div>Text<p></p></div>", $parent->outerHTML);
    }
    public function testAfter()
    {
        $parent = $this->doc->createElement("div");
        $child =  $this->doc->createElement("p");
        $parent->appendChild($child);

        $span =  $this->doc->createElement("span");
        $child->after($span);
        $this->assertEquals("<div><p></p><span></span></div>", $parent->outerHTML);

        //-----------------
        $parent =  $this->doc->createElement("div");;
        $child = $this->doc->createElement("p");
        $parent->appendChild($child);

        $child->after("Text");
        $this->assertEquals("<div><p></p>Text</div>", $parent->outerHTML);
    }

    public function testReplaceWith()
    {
        $parent = $this->doc->createElement("div");
        $child = $this->doc->createElement("p");
        $parent->appendChild($child);

        $span = $this->doc->createElement("span");
        $child->replaceWith($span);
        $this->assertEquals("<div><span></span></div>", $parent->outerHTML);
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

        $this->assertEquals("<div><p></p><span>abc</span></div>", (string)$div);
    }

    public function test_classList()
    {
        $div = p("<div class='c1 c2'>abc</div>")[0];
        $div->classList->add("abc");
        $this->assertEquals('<div class="c1 c2 abc">abc</div>', (string)$div);

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
        $div->classList[]="c4";
        $this->assertEquals($div->classList->length, 4);
    }
}
