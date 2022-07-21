<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\OrderedShipment;

use Inspirum\Balikobot\Client\Request\Carrier;

interface OrderedShipmentFactory
{
    /**
     * @param array<string>       $packageIds
     * @param array<string,mixed> $data
     */
    public function create(Carrier $carrier, array $packageIds, array $data): OrderedShipment;
}
