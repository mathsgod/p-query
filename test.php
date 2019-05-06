<?

class C
{

    public $c = 1;
}

class A
{
    public $a;
}

class B extends A
{

    public  $s;

    public function getTest(int $a = null)
    {
        if (__DIR__ == "abc") {
            return null;
        } else {
            return new C();
        }
    }
}

$b = new B();
$b->s = 1;
$b->getTest();
