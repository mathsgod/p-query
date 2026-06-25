<?php

declare(strict_types=1);
error_reporting(E_ALL & ~E_WARNING);

use PHPUnit\Framework\TestCase;
use P\Element;
use P\MutationObserver;
use P\MutationObserverRegistration;

final class MutationObserverRegistrationTest extends TestCase
{
    public function test_constructor_sets_properties()
    {
        $observer = new MutationObserver(function () {});
        $element = new Element("div");
        $options = ["childList" => true];

        $registration = new MutationObserverRegistration($observer, $element, $options);

        $this->assertSame($observer, $registration->observer);
        $this->assertSame($element, $registration->element);
        $this->assertEquals($options, $registration->options);
    }

    public function test_default_options()
    {
        $observer = new MutationObserver(function () {});
        $element = new Element("div");

        $registration = new MutationObserverRegistration($observer, $element, []);
        $this->assertIsArray($registration->options);
        $this->assertEmpty($registration->options);
    }
}
