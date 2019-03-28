<?
namespace P;

class CSSStyleDeclaration
{
    private $attr;
    public function __construct(Attr $attr)
    {
        $this->attr = $attr;
    }

    public function __set($name, $value)
    {

        $name = preg_replace_callback("/[A-Z]+/", function ($a) {
            return "-"  . strtolower($a[0]);
        }, $name);

        $values = [];
        foreach (explode(";", $this->attr->nodeValue) as $v) {
            list($a, $b) = explode(":", $v);
            $values[$a] = $b;
        }

        $values[$name] = $value;

        $str = [];
        foreach ($values as $n => $v) {
            $str[] = $n . ": $v";
        }


        $this->attr->nodeValue = implode("; ", $str);
    }

    public function __get($name)
    {
        switch ($name) {
            case "cssText":
                return $this->attr->nodeValue;
                break;
        }

        $values = [];
        foreach (explode(";", $this->attr->nodeValue) as $v) {
            list($a, $b) = explode(":", $v);
            $values[$a] = $b;
        }

        $name = preg_replace_callback("/[A-Z]+/", function ($a) {
            return "-"  . strtolower($a[0]);
        }, $name);

        
        return $values[$name];
    }
}
