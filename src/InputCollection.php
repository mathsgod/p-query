<?
namespace P;

class InputCollection extends Query
{
    public function required($value = true): self
    {
        foreach ($this as $node) {
            $node->setAttribute("required", $value);
        }
        return $this;
    }

    public function minlength($value): self
    {
        foreach ($this as $node) {
            $node->setAttribute("minlength", $value);
        }
        return $this;
    }

    public function type($value): self
    {
        foreach ($this as $node) {
            $node->setAttribute("type", $value);
        }
        return $this;
    }

    public function min($value): self
    {
        foreach ($this as $node) {
            $node->setAttribute("min", $value);
        }
        return $this;
    }

    public function max($value): self
    {
        foreach ($this as $node) {
            $node->setAttribute("max", $value);
        }
        return $this;
    }

    public function name($value): self
    {
        foreach ($this as $node) {
            $node->attributes("name", $value);
        }
        return $this;
    }
}
