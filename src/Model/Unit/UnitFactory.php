<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Unit;

interface UnitFactory
{
    /**
     * @param array<string,mixed> $data
     */
    public function create(array $data): Unit;

    /**
     * @param array<string,mixed> $data
     */
    public function createCollection(array $data): UnitCollection;
}
