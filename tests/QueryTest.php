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

    public function testData()
    {
        $p = p("<div></div>");

        $p->data("a", 1);
        $this->assertEquals($p->data("a"), 1);
        //$this->assertEquals((string)$p, '<div data-a="1"></div>');
    }


    public function test_append()
    {
        $p = p("<button>test</button>");
        $i = p("<i class='fa fa-fw'></i>");
        $p->append($i);
        $this->assertEquals((string)$p[0], '<button>test<i class="fa fa-fw"></i></button>');
    }
    public function test_prepend()
    {
        $p = p("<button>test</button>");
        $i = p("<i class='fa fa-fw'></i>");
        $p->prepend($i);
        $this->assertEquals((string)$p[0], '<button><i class="fa fa-fw"></i>test</button>');
    }
    public function test_appendTo()
    {
        $p = p("<button>test</button>");
        $i = p("<i class='fa fa-fw'></i>");
        $i->appendTo($p);
        $this->assertEquals((string)$p[0], '<button>test<i class="fa fa-fw"></i></button>');
    }

    public function test_prependTo()
    {
        $p = p("<button>test</button>");
        $i = p("<i class='fa fa-fw'></i>");
        $i->prependTo($p);
        $this->assertEquals((string)$p[0], '<button><i class="fa fa-fw"></i>test</button>');
    }

    public function test_attr()
    {
        $d = p("<div id='div0'>test</div>");
        $this->assertEquals($d->attr("id"), "div0");
        $d->attr('id', 'div1');
        $this->assertEquals($d->attr("id"), "div1");
    }

    public function test_after()
    {
        $p = p('<div class="container"><h2>Greetings</h2><div class="inner">Hello</div><div class="inner">Goodbye</div></div>');
        $p->find(".inner")->after("<p>Test</p>");
        $this->assertEquals((string)$p[0], '<div class="container"><h2>Greetings</h2><div class="inner">Hello</div><p>Test</p><div class="inner">Goodbye</div><p>Test</p></div>');
    }

    public function test_before()
    {
        $p = p('<div class="container"><h2>Greetings</h2><div class="inner">Hello</div><div class="inner">Goodbye</div></div>');
        $p->find(".inner")->before("<p>Test</p>");
        $this->assertEquals((string)$p[0], '<div class="container"><h2>Greetings</h2><p>Test</p><div class="inner">Hello</div><p>Test</p><div class="inner">Goodbye</div></div>');
    }

    public function test_css()
    {
        $p = p('<div style="background-color:blue;"></div>');
        $this->assertEquals($p->css("background-color"), "blue");
    }

    public function test_removeAttr()
    {
        $p = p('<div style="background-color:blue;"></div>');
        $p->removeAttr("style");
        $this->assertEquals("<div></div>", (string)$p[0]);
    }

    public function test_val()
    {
        $p = p("<select><option value='1'></option><option value='2' selected></option></select>");
        $this->assertEquals("2", (string)$p->val());

        $p = p("<select multiple><option value='1' selected></option><option value='2' selected></option></select>");

        $this->assertEquals(2, count($p->val()));
    }

    public function test_wrap()
    {
        $p = p('<div class="container"><div class="inner">Hello</div><div class="inner">Goodbye</div></div>');
        $p->find(".inner")->wrap("<div class='new'></div>");
        $this->assertEquals('<div class="container"><div class="new"><div class="inner">Hello</div></div><div class="new"><div class="inner">Goodbye</div></div></div>', (string)$p[0]);
    }

    public function test_wrapinner()
    {
        $p = p('<div class="container"><div class="inner">Hello</div><div class="inner">Goodbye</div></div>');
        $p->find(".inner")->wrapInner("<div class='new'></div>");
        $this->assertEquals('<div class="container"><div class="inner"><div class="new">Hello</div></div><div class="inner"><div class="new">Goodbye</div></div></div>', (string)$p[0]);
    }

    public function test_prev()
    {
        $p = p("<div><span>abc</span><p></p></div>");
        $this->assertEquals("<span>abc</span>", (string)$p->find("p")->prev()[0]);
    }
    public function test_next()
    {
        $p = p("<div><span>abc</span><p>xyz</p></div>");
        $this->assertEquals("<p>xyz</p>", (string)$p->find("span")->next()[0]);
    }

    public function test_index()
    {
        $p = p("<div><span>abc</span><p>xyz</p></div>");

        $this->assertEquals(0, $p->find("span")->index());
        $this->assertEquals(1, $p->find("p")->index());
    }
}
