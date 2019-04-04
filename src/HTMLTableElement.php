<?
namespace P;

class HTMLTableElement extends HTMLElement
{

    const ATTRIBUTES = ["align" => "string"] + parent::ATTRIBUTES;

    public function __construct($value = "", $uri = null)
    {
        parent::__construct("table", $value, $uri);
    }

    public function __get($name)
    {
        switch ($name) {
            case "caption":
                foreach ($this->childNodes as $node) {
                    if ($node->tagName == "caption") {
                        return $node;
                    }
                }
                break;
            case 'tBodies':
                $collection = new HTMLCollection();
                foreach ($this->childNodes as $node) {
                    if ($node->tagName == "tbody") {
                        $collection[] = $node;
                    }
                }
                return $collection;
                break;
            case 'tHead':
                foreach ($this->childNodes as $node) {
                    if ($node->tagName == "thead") {
                        return $node;
                    }
                }
                break;
            case "tFoot":
                foreach ($this->childNodes as $child) {
                    if ($node->tagName == "tfoot") {
                        return $node;
                    }
                }
                break;
        }

        return parent::__get($name);
    }

    public function __set($name, $value)
    {
        switch ($name) {
            case "tHead":
                if (!$value instanceof Element) {
                    throw new TypeError("The provided value is not of type 'Element'.");
                }

                if ($value && $value->tagName != "thead") {
                    throw new DOMException("Not a thead element.");
                }

                $this->deleteTHead();

                if (!$value)
                    return;

                for ($child = $this->firstChildElement; $child; $child = $child->nextElementSibling) {
                    if (!$child->tagName != "caption" && !$child->tagName != "colgroup") {
                        break;
                    }
                }
                $this->insertBefore($value, $child);
                return;
            case "tFoot":
                if (!$value instanceof HTMLTableSectionElement) {
                    throw new TypeError("The provided value is not of type 'Element'.");
                }

                if ($value && $value->tagName != "tfoot") {
                    throw new DOMException("Not a tfoot element.");
                }

                $this->deleteTFoot();
                if ($value)
                    $this->appendChild($value);

                return;
        }

        parent::__set($name, $value);
    }


    public function createTBody()
    {
        $tbody = $this->ownerDocument->createElement("tbody");

        if ($this->tBodies->length == 0) {
            $this->appendChild($tbody);
        } else {
            //find last body
            $this->tBodies[$this->tBodies->length - 1]->after($tbody);
        }

        return $tbody;
    }

    public function createTHead()
    {
        if ($this->tHead) {
            return $this->tHead;
        }
        $thead = $this->ownerDocument->createElement('thead');
        $this->prependChild($thead);
        return $thead;
    }

    public function createTFoot()
    {
        if ($this->tFoot) {
            return $this->tFoot;
        }
        $tfoot = $this->ownerDocument->createElement('tfoot');
        $this->appendChild($tfoot);
        return $tfoot;
    }

    public function insertRow($index = -1)
    {
        if ($this->tBodies->length == 0) {
            $tbody = $this->createTBody();
        } else {
            $tbody = $this->tBodies[$this->tBodies->length - 1];
        }
        return $tbody->insertRow($index);
    }

    public function deleteTHead()
    {
        if ($thead = $this->tHead) {
            $thead->remove();
        }
    }

    public function deleteCaption()
    {
        if ($caption = $this->caption) {
            $caption->remove();
        }
    }

    public function deleteTFoot()
    {
        if ($tfoot = $this->tfoot) {
            $tfoot->remove();
        }
    }
}
