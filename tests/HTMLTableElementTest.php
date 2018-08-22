<?
declare (strict_types = 1);
error_reporting(E_ALL && ~E_WARNING);
use PHPUnit\Framework\TestCase;
use P\HTMLTableElement;

final class HTMLTableElementTest extends TestCase
{
    const HTML = <<<HTML
<table></table>
HTML;

    public function testCreate()
    {
        $e = new P\HTMLTableElement();
        $this->assertInstanceOf(
            P\HTMLTableElement::class,
            $e
        );
    }

    public function test_createTHead()
    {
        $t = new P\HTMLTableElement();
        $h = $t->createTHead();

        $this->assertInstanceOf(P\HTMLTableSectionElement::class, $h);
        $this->assertEquals("<table><thead></thead></table>", $t->outerHTML);

        $bhody = $t->createTHead();
        $this->assertInstanceOf(P\HTMLTableSectionElement::class, $h);
        $this->assertEquals("<table><thead></thead></table>", $t->outerHTML);
    }

    public function test_createTBody()
    {
        $t = new P\HTMLTableElement();
        $body = $t->createTBody();

        $this->assertInstanceOf(P\HTMLTableSectionElement::class, $body);
        $this->assertEquals("<table><tbody></tbody></table>", $t->outerHTML);

        $body = $t->createTBody();
        $this->assertInstanceOf(P\HTMLTableSectionElement::class, $body);
        $this->assertEquals("<table><tbody></tbody><tbody></tbody></table>", $t->outerHTML);
    }

    public function test_createTFoot()
    {
        $t = new P\HTMLTableElement();
        $f = $t->createTFoot();

        $this->assertInstanceOf(P\HTMLTableSectionElement::class, $f);
        $this->assertEquals("<table><tfoot></tfoot></table>", $t->outerHTML);

    }

    public function test_insertRow(){
        $t = new P\HTMLTableElement();
        $r=$t->insertRow();

        $this->assertInstanceOf(P\HTMLTableRowElement::class, $r);
        
        $this->assertEquals("<table><tbody><tr></tr></tbody></table>", $t->outerHTML);
    }


}