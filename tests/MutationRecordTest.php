<?php

declare(strict_types=1);
error_reporting(E_ALL & ~E_WARNING);

use PHPUnit\Framework\TestCase;
use P\Element;
use P\MutationRecord;

final class MutationRecordTest extends TestCase
{
    public function test_properties()
    {
        $record = new MutationRecord();
        $record->type = "childList";
        $record->target = new Element("div");
        $record->addedNodes = [];
        $record->removeNodes = [];

        $this->assertEquals("childList", $record->type);
        $this->assertInstanceOf(Element::class, $record->target);
        $this->assertIsArray($record->addedNodes);
        $this->assertIsArray($record->removeNodes);
    }
}
