<?php

declare(strict_types=1);
error_reporting(E_ALL && ~E_WARNING);

use PHPUnit\Framework\TestCase;
use P\Query;

final class QueryTest extends TestCase
{
    const HTML = <<<HTML
<div class="container"><div class="hello">Hello</div><div class="goodbye">Goodbye</div></div>
HTML;



    public function test_find()
    {
        $p = p("<table><tbody></tbody></table>");
        $tbody = $p->find("tbody");
        $this->assertEquals("<tbody></tbody>", (string) $tbody);
    }

    public function test_href()
    {
        $html = file_get_contents(__DIR__ . "/html/no_href.html");
        $p = p($html)->find("a");
        $this->assertInstanceOf(Query::class, $p);
        $this->assertNull($p->attr("href"));

        $html = file_get_contents(__DIR__ . "/html/has_href.html");
        $p = p($html)->find("a");
        $this->assertInstanceOf(Query::class, $p);
        $this->assertNotNull($p->attr("href"));
    }

    public function testCreate()
    {
        $html = <<<HTML
<div class="container"><div class="hello">Hello</div><div class="goodbye">Goodbye</div></div>
HTML;
        $p = p($html);

        $this->assertEquals('<div class="hello">Hello</div><div class="goodbye">Goodbye</div>', str_replace("\n", "", $p->html()));
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

    public function test_remove2()
    {
        $div = p("<div><span>a<p>b</p>c<p>d</p></span></div>");
        $div->find("p")->remove();
        $this->assertEquals("<div><span>ac</span></div>", (string) $div);
    }

    public function testEmpty()
    {
        $p = p(self::HTML);
        $p->empty();
        $this->assertEquals('<div class="container"></div>', (string) $p[0]);
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
        $this->assertEquals((string) $p[0], '<button>test<i class="fa fa-fw"></i></button>');


        $p = p("<button></button>");

        $p->append(' <span class="caret"></span>');
        $this->assertEquals('<button> <span class="caret"></span></button>', (string) $p);
    }
    public function test_prepend()
    {
        $p = p("<button>test</button>");
        $i = p("<i class='fa fa-fw'></i>");
        $p->prepend($i);
        $this->assertEquals((string) $p[0], '<button><i class="fa fa-fw"></i>test</button>');
    }
    public function test_appendTo()
    {
        $p = p("<button>test</button>");
        $i = p("<i class='fa fa-fw'></i>");
        $i->appendTo($p);
        $this->assertEquals((string) $p[0], '<button>test<i class="fa fa-fw"></i></button>');

        $li = p("li")[0];
        p("a")->text("google")->appendTo($li);

        $this->assertEquals('<li><a>google</a></li>', (string) $li);
    }

    public function test_prependTo()
    {
        $p = p("<button>test</button>");
        $i = p("<i class='fa fa-fw'></i>");
        $i->prependTo($p);
        $this->assertEquals((string) $p[0], '<button><i class="fa fa-fw"></i>test</button>');
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
        $this->assertEquals('<div class="container"><h2>Greetings</h2><div class="inner">Hello</div><p>Test</p><div class="inner">Goodbye</div><p>Test</p></div>', str_replace("\n", "", $p));
    }

    public function test_before()
    {
        $p = p('<div class="container"><h2>Greetings</h2><div class="inner">Hello</div><div class="inner">Goodbye</div></div>');
        $p->find(".inner")->before("<p>Test</p>");
        $this->assertEquals('<div class="container"><h2>Greetings</h2><p>Test</p><div class="inner">Hello</div><p>Test</p><div class="inner">Goodbye</div></div>', str_replace("\n", "", $p));
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
        $this->assertEquals("<div></div>", (string) $p[0]);
    }

    public function test_val()
    {
        $p = p("<select><option value='1'></option><option value='2' selected></option></select>");
        $this->assertEquals("2", (string) $p->val());

        $p = p("<select multiple><option value='1' selected></option><option value='2' selected></option></select>");

        $this->assertEquals(2, count($p->val()));
    }

    public function test_wrap()
    {
        $p = p('<div class="container"><div class="inner">Hello</div><div class="inner">Goodbye</div></div>');
        $p->find(".inner")->wrap("<div class='new'></div>");
        $this->assertEquals('<div class="container"><div class="new"><div class="inner">Hello</div></div><div class="new"><div class="inner">Goodbye</div></div></div>', str_replace("\n", "", $p));
    }

    public function test_wrapinner()
    {
        $p = p('<div class="container"><div class="inner">Hello</div><div class="inner">Goodbye</div></div>');
        $p->find(".inner")->wrapInner("<div class='new'></div>");
        $this->assertEquals('<div class="container"><div class="inner"><div class="new">Hello</div></div><div class="inner"><div class="new">Goodbye</div></div></div>', str_replace("\n", "", $p));
    }

    public function test_prev()
    {
        $p = p("<div><span>abc</span><p></p></div>");
        $this->assertEquals("<span>abc</span>", (string) $p->find("p")->prev()[0]);
    }
    public function test_next()
    {
        $p = p("<div><span>abc</span><p>xyz</p></div>");
        $this->assertEquals("<p>xyz</p>", (string) $p->find("span")->next()[0]);
    }

    public function test_index()
    {
        $p = p("<div><span>abc</span><p>xyz</p></div>");

        $this->assertEquals(0, $p->find("span")->index());
        $this->assertEquals(1, $p->find("p")->index());
    }

    public function test_hasClass()
    {
        $p = p("<div class='c1'><span>abc</span><p>xyz</p></div>");
        $this->assertTrue($p->hasClass("c1"));
        $this->assertFalse($p->hasClass("c2"));
    }

    public function test_event()
    {
        $p = p("<input value='1' />");

        $p->on("change", function ($e) {
            $this->assertEquals("change", $e->type);
        });

        $p->trigger("change");
    }

    public function test_change()
    {
        $p = p("<div></div>");

        $p->on("change", function ($e) {
            $this->assertEquals("change", $e->type);
        });

        $p->attr("test", 1);
    }

    public function test_attr_func()
    {
        $p = p("<div id='id1'></div>");
        $p->attr("a", function () {
            return "b";
        });
        $this->assertEquals("b", $p->attr("a"));

        $p->attr("b", function () {
            return $this->getAttribute("a");
        });

        $this->assertEquals("b", $p->attr("b"));
    }
}
