<?php

declare(strict_types=1);
error_reporting(E_ALL & ~E_WARNING);

use PHPUnit\Framework\TestCase;

use P\HTMLDivElement;
use P\HTMLSpanElement;
use P\MutationObserver;

final class MutationObserverTest extends TestCase
{
    public function test_observe()
    {
        $div = new HTMLDivElement();

        $span = new HTMLSpanElement();

        $observer = new MutationObserver(function ($list) use ($div, $span) {

            $this->assertIsArray($list);

            $this->assertEquals($div, $list[0]->target);

            $this->assertEquals($span, $list[0]->addedNodes[0]);
        });

        $observer->observe($div, [
            "childList" => true
        ]);

        $div->appendChild($span);
    }
}
