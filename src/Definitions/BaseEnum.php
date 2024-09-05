<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Definitions;

use ReflectionClass;
use function array_values;

abstract class BaseEnum
{
    /**
     * @return list<string>
     */
    public static function getAll(): array
    {
        $class = new ReflectionClass(static::class);

        return array_values($class->getConstants());
    }
}
