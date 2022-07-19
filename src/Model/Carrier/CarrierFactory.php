<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Carrier;

use Inspirum\Balikobot\Client\Request\CarrierType;

interface CarrierFactory
{
    /**
     * @param array<string,mixed> $data
     */
    public function create(CarrierType $carrier, array $data): Carrier;

    /**
     * @param array<array<int,mixed>> $data
     */
    public function createCollection(array $data): CarrierCollection;
}
