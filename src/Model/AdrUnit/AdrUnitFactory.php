<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\AdrUnit;

use Inspirum\Balikobot\Client\Request\CarrierType;

interface AdrUnitFactory
{
    /**
     * @param array<string,mixed> $data
     */
    public function create(CarrierType $carrier, array $data): AdrUnit;

    /**
     * @param array<string,mixed> $data
     */
    public function createCollection(CarrierType $carrier, array $data): AdrUnitCollection;
}
