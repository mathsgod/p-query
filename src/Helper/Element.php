<?

namespace P\Helper;

class Element
{
    protected $element;
    public function __construct(\P\Element $element)
    {
        $this->element = $element;
    }

    public function __set($name, $value)
    {
        $this->$name = $value;
    }

    public function __get($name)
    {
        return $this->$name;
    }
}
