<?
namespace P\Helper;

class HTMLTableSectionElement extends Element
{
    public function insertRow()
    {
        $row = $this->element->ownerDocument->createElement("tr");
        $this->element->appendChild($row);
        return $row;
    }

    public function __get($name)
    {
        switch ($name) {
            case "rows":
                $collection = new HTMLCollection();
                foreach ($this->element->childNodes as $node) {
                    $collection[] = $node;
                }
                return $collection;
        }
        return parent::__get($name);
    }
}
