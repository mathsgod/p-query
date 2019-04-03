<?
declare (strict_types = 1);
error_reporting(E_ALL && ~E_WARNING);

use PHPUnit\Framework\TestCase;
use P\Document;

final class HTMLSelectElementTest extends TestCase
{
    public function test_value()
    {

        $s = p("<select><option value='1'>1</option><option value='2'>2</option></select>")[0];

        $s->value = 2;

        $this->assertEquals('<select><option value="1">1</option><option value="2" selected>2</option></select>', (string)$s);
    }
}
