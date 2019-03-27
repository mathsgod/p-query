<?

namespace P\Helper;

use \DOMException;
use \P\HTMLCollection;
use \P\TypeError;

class HTMLTableElement extends Element
{

    public function __get($name)
    {
        switch ($name) {
            case "caption":
                foreach ($this->element->childNodes as $node) {
                    if ($node->tagName == "caption") {
                        return $node;
                    }
                }
                break;
            case 'tBodies':
                $collection = new HTMLCollection();
                foreach ($this->element->childNodes as $node) {
                    if ($node->tagName == "tbody") {
                        $collection[] = $node;
                    }
                }
                return $collection;
                break;
            case 'tHead':
                foreach ($this->element->childNodes as $node) {
                    if ($node->tagName == "thead") {
                        return $node;
                    }
                }
                break;
            case "tFoot":
                foreach ($this->element->childNodes as $child) {
                    if ($node->tagName == "tfoot") {
                        return $node;
                    }
                }
                break;
        }

        return $this->$name;
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

                for ($child = $this->element->firstChildElement; $child; $child = $child->nextElementSibling) {
                    if (!$child->tagName != "caption" && !$child->tagName != "colgroup") {
                        break;
                    }
                }
                $this->element->insertBefore($value, $child);
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
                    $this->element->appendChild($value);

                return;
        }

        parent::__set($name, $value);
    }


    public function createTBody()
    {
        $tbody = $this->element->ownerDocument->createElement("tbody");

        if ($this->tBodies->length == 0) {
            $this->element->appendChild($tbody);
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
        $thead = $this->element->ownerDocument->createElement('thead');
        $this->element->prepend($thead);
        return $thead;
    }

    public function createTFoot()
    {
        if ($this->tFoot) {
            return $this->tFoot;
        }
        $tfoot = $this->element->ownerDocument->createElement('tfoot');
        $this->element->append($tfoot);
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
