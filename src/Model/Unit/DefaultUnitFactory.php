<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Unit;

use Inspirum\Balikobot\Client\Request\Carrier;
use function array_map;

final class DefaultUnitFactory implements UnitFactory
{
    /** @inheritDoc */
    public function create(array $data): Unit
    {
        return new Unit((string) $data['code'], $data['name']);
    }

    /** @inheritDoc */
    public function createCollection(Carrier $carrierType, array $data): UnitCollection
    {
        return new UnitCollection(
            $carrierType,
            array_map(fn(array $unit): Unit => $this->create($unit), $data['units'] ?? []),
        );
    }
}
