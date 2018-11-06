<?

namespace P;

class HTMLTableSectionElement extends HTMLElement
{

    public function insertRow()
    {
        $row = new HTMLTableRowElement();
        $this->appendChild($row);
        return $row;
    }

    public function __get($name)
    {
        if ($name == "rows") {
            $collection = new HTMLCollection();
            foreach ($this->children as $child) {
                $collection[] = $child;
            }
            return $collection;
        }
        return parent::__get($name);
    }
}
