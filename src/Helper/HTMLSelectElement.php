<?
namespace P\Helper;

class HTMLSelectElement extends Element
{
    public function add(\P\Element $item)
    {
        $this->element->appendChild($item);
    }
}
