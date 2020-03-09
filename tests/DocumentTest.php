<?
declare (strict_types = 1);
error_reporting(E_ALL && ~E_WARNING);
use PHPUnit\Framework\TestCase;
use P\Document;


final class DocumentTest extends TestCase
{

    public function test_create()
    {
        $doc = new Document();
        $this->assertInstanceOf(Document::class, $doc);
    }

}
