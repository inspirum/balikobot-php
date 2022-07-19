<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Branch;

use Inspirum\Balikobot\Client\Request\CarrierType;
use Inspirum\Balikobot\Client\Request\ServiceType;

interface BranchFactory
{
    /**
     * Create branch from API response data
     *
     * @param array<string,mixed> $data
     */
    public function createFromData(CarrierType $carrier, ?ServiceType $service, array $data): Branch;
}
