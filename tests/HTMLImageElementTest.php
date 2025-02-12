<?php
use PHPUnit\Framework\TestCase;
use P\HTMLImageElement;



class HTMLImageElementTest extends TestCase
{
    public function testWidthProperty()
    {
        $imageElement = new HTMLImageElement();
        $imageElement->width = 300;
        $this->assertEquals(300, $imageElement->width);

        $imageElement->width = 500;
        $this->assertEquals(500, $imageElement->width);
    }

    public function testWidthPropertyWithInvalidValue()
    {
        $imageElement = new HTMLImageElement();
        $imageElement->width = "invalid";
        $this->assertEquals(0, $imageElement->width);
    }
}