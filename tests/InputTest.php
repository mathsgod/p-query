<?
declare (strict_types = 1);
error_reporting(E_ALL && ~E_WARNING);
use PHPUnit\Framework\TestCase;
use P\Document;

final class InputTest extends TestCase
{
    public function test_input_get_set()
    {
        $doc = new Document();
        $input = $doc->createElement("input");
        $input->name = "input1";
        $this->assertEquals((string)$input, '<input name="input1">');


        $input = p("<input name='input1'/>")[0];
        $this->assertEquals($input->name, "input1");
    }
}
