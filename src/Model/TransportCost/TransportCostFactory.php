<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\TransportCost;

use Inspirum\Balikobot\Client\Request\Carrier;

interface TransportCostFactory
{
    /**
     * @param array<string,mixed> $data
     */
    public function create(Carrier $carrier, array $data): TransportCost;

    /**
     * @param array<string,mixed> $data
     */
    public function createCollection(Carrier $carrier, array $data): TransportCostCollection;
}
