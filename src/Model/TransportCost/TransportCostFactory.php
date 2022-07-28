<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\TransportCost;

interface TransportCostFactory
{
    /**
     * @param array<string,mixed> $data
     */
    public function create(string $carrier, array $data): TransportCost;

    /**
     * @param array<string,mixed> $data
     */
    public function createCollection(string $carrier, array $data): TransportCostCollection;
}
