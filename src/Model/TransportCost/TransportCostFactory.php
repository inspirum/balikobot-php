<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\TransportCost;

use Inspirum\Balikobot\Client\Request\CarrierType;

interface TransportCostFactory
{
    /**
     * @param array<string,mixed> $data
     */
    public function create(CarrierType $carrier, array $data): TransportCost;

    /**
     * @param array<string,mixed> $data
     */
    public function createCollection(CarrierType $carrier, array $data): TransportCostCollection;
}
