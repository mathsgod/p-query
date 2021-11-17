<?php

namespace P;

use Closure;
use ReflectionFunction;

class Reflect
{
    static function apply(callable $target, $thisArgument, array $argumentsList = [])
    {
        $function = new ReflectionFunction($target);
        return $function->getClosure()->bindTo($thisArgument)->__invoke(...$argumentsList);
    }

    static function has($target, $propertyKey)
    {
        return property_exists($target, $propertyKey);
    }
}
