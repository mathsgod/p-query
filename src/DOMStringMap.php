<?php
namespace P;

class DOMStringMap
{
    private Element $element;

    public function __construct(Element $e)
    {
        $this->element = $e;
    }

    /**
     * @param string $name
     * @param mixed $value
     */
    public function __set($name, $value): void
    {
        $name = preg_replace_callback("/[A-Z]+/", function ($a) {
            return "-"  . strtolower($a[0]);
        }, $name);

        $this->element->setAttribute("data-" . $name, $value);
    }

    /**
     * @param string $name
     * @return string
     */
    public function __get($name)
    {
        $name = preg_replace_callback("/[A-Z]+/", function ($a) {
            return "-"  . strtolower($a[0]);
        }, $name);

        return $this->element->getAttribute("data-" . $name);
    }
}
