<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Unit;

use Inspirum\Balikobot\Client\Request\Carrier;

interface UnitFactory
{
    /**
     * @param array<string,mixed> $data
     */
    public function create(array $data): Unit;

    /**
     * @param array<string,mixed> $data
     */
    public function createCollection(Carrier $carrierType, array $data): UnitCollection;
}
