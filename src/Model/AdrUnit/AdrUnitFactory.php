<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\AdrUnit;

use Inspirum\Balikobot\Client\Request\Carrier;

interface AdrUnitFactory
{
    /**
     * @param array<string,mixed> $data
     */
    public function create(Carrier $carrier, array $data): AdrUnit;

    /**
     * @param array<string,mixed> $data
     */
    public function createCollection(Carrier $carrier, array $data): AdrUnitCollection;
}
