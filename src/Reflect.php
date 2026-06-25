<?php

namespace P;

use ReflectionFunction;

class Reflect
{
    public static function apply(callable $target, mixed $thisArgument, array $argumentsList = []): mixed
    {
        $function = new ReflectionFunction($target);
        return $function->getClosure()->bindTo($thisArgument)->__invoke(...$argumentsList);
    }

    public static function has(mixed $target, string $propertyKey): bool
    {
        return property_exists($target, $propertyKey);
    }
}
