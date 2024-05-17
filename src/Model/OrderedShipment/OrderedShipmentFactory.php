<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\OrderedShipment;

interface OrderedShipmentFactory
{
    /**
     * @param array<string> $packageIds
     * @param array<string,mixed> $data
     */
    public function create(string $carrier, array $packageIds, array $data): OrderedShipment;
}
