<?

declare (strict_types = 1);
error_reporting(E_ALL && ~E_WARNING);

use PHPUnit\Framework\TestCase;
use P\Document;

final class HTMLTableElementTest extends TestCase
{
    const HTML = <<<HTML
<table></table>
HTML;

public function test_createTHead()
    {

        $doc = new Document();
        $t = $doc->createElement("table");
        $h = $t->createTHead();

        $this->assertInstanceOf(P\Element::class, $h);
        $this->assertEquals("<table><thead></thead></table>", $t->outerHTML);

        $bhody = $t->createTHead();
        $this->assertInstanceOf(P\Element::class, $h);
        $this->assertEquals("<table><thead></thead></table>", $t->outerHTML);
    }

    public function test_createTBody()
    {
        $doc = new Document();
        $t = $doc->createElement("table");
        $body = $t->createTBody();

        $this->assertInstanceOf(P\Element::class, $body);
        $this->assertEquals("<table><tbody></tbody></table>", $t->outerHTML);

        $body = $t->createTBody();
        $this->assertInstanceOf(P\Element::class, $body);
        $this->assertEquals("<table><tbody></tbody><tbody></tbody></table>", $t->outerHTML);
    }

    public function test_createTFoot()
    {
        $doc = new Document();
        $t = $doc->createElement("table");

        $f = $t->createTFoot();

        $this->assertInstanceOf(P\Element::class, $f);
        $this->assertEquals("<table><tfoot></tfoot></table>", $t->outerHTML);
    }

    public function test_insertRow()
    {
        $doc = new Document();
        $t = $doc->createElement("table");

        $r = $t->insertRow();

        $this->assertInstanceOf(P\Element::class, $r);

        $this->assertEquals("<table><tbody><tr></tr></tbody></table>", $t->outerHTML);
    }
}

