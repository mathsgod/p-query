<?
namespace P;

class Event
{
    public $type;

    public function __construct(string $type)
    {
        $this->type=$type;
        
    }
}
