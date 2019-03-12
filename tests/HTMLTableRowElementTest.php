<?
declare (strict_types = 1);
error_reporting(E_ALL && ~E_WARNING);
use PHPUnit\Framework\TestCase;
use P\HTMLTableRowElement;

final class HTMLTableRowElementTest extends TestCase
{
    public function test_insertCell()
    {
        $row = new HTMLTableRowElement();
        $cell = $row->insertCell();
        $this->assertEquals((string)$row, "<tr><td></td></tr>");


        $row = new HTMLTableRowElement();
        $cell = $row->insertCell();
        $cell->textContent = "cell content";
        $this->assertEquals((string)$row, "<tr><td>cell content</td></tr>");
    }
}
