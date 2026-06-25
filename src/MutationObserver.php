<?php

namespace P;

class MutationObserver
{
    /** @var callable */
    public $callable;

    public function __construct(callable $callable)
    {
        $this->callable = $callable;
    }

    public function observe(Element $target, array $options): void
    {
        $target->registerMutationObserver($this, $options);
    }

    public function disconnect(): void
    {
    }

    public function takeRecords(): array
    {
        return [];
    }
}
