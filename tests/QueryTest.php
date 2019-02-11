<?
declare (strict_types = 1);
error_reporting(E_ALL && ~E_WARNING);
use PHPUnit\Framework\TestCase;

final class QueryTest extends TestCase
{
    const HTML = <<<HTML
<div class="container"><div class="hello">Hello</div><div class="goodbye">Goodbye</div></div>
HTML;

    public function testCreate()
    {
        $html = <<<HTML
<div class="container"><div class="hello">Hello</div><div class="goodbye">Goodbye</div></div>
HTML;
        $p = p($html);

        $this->assertEquals('<div class="hello">Hello</div><div class="goodbye">Goodbye</div>', $p->html());
    }

    public function testRemove()
    {
        $html = <<<HTML
<div class="container"><div class="hello">Hello</div><div class="goodbye">Goodbye</div></div>
HTML;
        $p = p($html);
        $p->find(".hello")->remove();

        $this->assertEquals('<div class="goodbye">Goodbye</div>', $p->html());


        $p = p(self::HTML);
        $p->remove(".hello");
        $this->assertEquals('<div class="goodbye">Goodbye</div>', $p->html());

    }

    public function testEmpty()
    {
        $p = p(self::HTML);
        $p->empty();
        $this->assertEquals('<div class="container"></div>', (string)$p[0]);
    }

    public function testClosest()
    {
        $p = p("<div id='1'><span>abc</span></div>");

        $this->assertEquals("1", $p->find("span")->closest("div")->attr("id"));
    }

    public function testVal()
    {
        $p = p("<input value='test'/>");
        $this->assertEquals($p->val(), "test");
    }


}