<?php
namespace P;

class InputCollection extends Query
{
    public function required(bool|string $value = true): self
    {
        foreach ($this as $node) {
            $node->setAttribute("required", $value);
        }
        $this->trigger("change");
        return $this;
    }

    public function minlength(string|int $value): self
    {
        foreach ($this as $node) {
            $node->setAttribute("minlength", $value);
        }
        $this->trigger("change");
        return $this;
    }

    public function type(string $value): self
    {
        foreach ($this as $node) {
            $node->setAttribute("type", $value);
        }
        $this->trigger("change");
        return $this;
    }

    public function min(string|int $value): self
    {
        foreach ($this as $node) {
            $node->setAttribute("min", $value);
        }
        $this->trigger("change");
        return $this;
    }

    public function max(string|int $value): self
    {
        foreach ($this as $node) {
            $node->setAttribute("max", $value);
        }
        $this->trigger("change");
        return $this;
    }

    public function name(string $value): self
    {
        foreach ($this as $node) {
            $node->attributes("name", $value);
        }
        $this->trigger("change");
        return $this;
    }
}
