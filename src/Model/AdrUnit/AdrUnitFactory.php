<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\AdrUnit;

interface AdrUnitFactory
{
    /**
     * @param array<string,mixed> $data
     */
    public function create(string $carrier, array $data): AdrUnit;

    /**
     * @param array<string,mixed> $data
     */
    public function createCollection(string $carrier, array $data): AdrUnitCollection;
}
