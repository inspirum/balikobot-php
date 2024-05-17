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
     * @param array<int,array<string,mixed>> $packages
     * @param array<string,mixed> $data
     *
     * @return \Inspirum\Balikobot\Model\TransportCost\TransportCostCollection&array<\Inspirum\Balikobot\Model\TransportCost\TransportCost>
     */
    public function createCollection(string $carrier, ?array $packages, array $data): TransportCostCollection;
}
