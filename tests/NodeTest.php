<?
declare (strict_types = 1);
error_reporting(E_ALL && ~E_WARNING);
use PHPUnit\Framework\TestCase;

use P\Element;
use P\Node;
use P\Text;
use P\Document;

final class NodeTest extends TestCase
{
    public function test_contains()
    {

        $div = p("<div><span>abc<p>pp</p></span></div>");
        $p = $div->find("p");
        $this->assertTrue($div[0]->contains($p[0]));

    }

    public function test_textContent()
    {
        $t = new P\Text("ABC");
        $this->assertEquals('ABC', $t->textContent);

        $e = new Element("div");
        $e->innerHTML = "a<span>b</span>c";
        $this->assertEquals('abc', $e->textContent);


        $e = new Element("div");
        $e->textContent = "testing123";
        $this->assertEquals('testing123', $e->textContent);
    }

    public function test_normalize()
    {

        $wrapper = Document::createElement("div");
        $wrapper->appendChild(Document::createTextNode("Part 1 "));
        $wrapper->appendChild(Document::createTextNode("Part 2 "));

        $this->assertEquals('Part 1 ', $wrapper->childNodes[0]->textContent);
        $this->assertEquals('Part 2 ', $wrapper->childNodes[1]->textContent);

        $wrapper->normalize();
        $this->assertEquals(1, count($wrapper->childNodes));
        $this->assertEquals('Part 1 Part 2 ', $wrapper->childNodes[0]->textContent);
    }



}