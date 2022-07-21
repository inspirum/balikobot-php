<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Branch;

use Inspirum\Balikobot\Client\Request\Carrier;
use Inspirum\Balikobot\Client\Request\Service;

interface BranchFactory
{
    /**
     * Create branch from API response data
     *
     * @param array<string,mixed> $data
     */
    public function createFromData(Carrier $carrier, ?Service $service, array $data): Branch;
}
