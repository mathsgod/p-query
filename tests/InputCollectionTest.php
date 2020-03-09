<?
declare (strict_types = 1);
error_reporting(E_ALL && ~E_WARNING);
use PHPUnit\Framework\TestCase;
use P\Document;
use P\InputCollection;
use P\Event;

final class InputCollectionTest extends TestCase
{
    public function test_event()
    {
        $collection = new InputCollection();

        $collection[] = p("<input>")[0];
        $collection->on("change", function (Event $e) {
            $this->assertEquals("change", $e->type);
        });

        $collection->required();
    }
}
