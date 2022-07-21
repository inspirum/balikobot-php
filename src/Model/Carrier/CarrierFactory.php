<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Carrier;

use Inspirum\Balikobot\Client\Request\Carrier;
use Inspirum\Balikobot\Model\Carrier\Carrier as CarrierModel;

interface CarrierFactory
{
    /**
     * @param array<string,mixed> $data
     */
    public function create(Carrier $carrier, array $data): CarrierModel;

    /**
     * @param array<array<int,mixed>> $data
     */
    public function createCollection(array $data): CarrierCollection;
}
