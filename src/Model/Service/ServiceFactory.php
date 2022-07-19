<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Service;

use Inspirum\Balikobot\Client\Request\CarrierType;

interface ServiceFactory
{
    /**
     * @param array<string,mixed> $data
     */
    public function create(CarrierType $carrier, array $data): Service;

    /**
     * @param array<string,mixed> $data
     */
    public function createCollection(CarrierType $carrier, array $data): ServiceCollection;
}
