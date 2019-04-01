<?
namespace P\Helper;
use DOMElement;
class HTMLSelectElement extends Element
{
    public function add(DOMElement $item)
    {
        $this->element->appendChild($item);
    }
}
