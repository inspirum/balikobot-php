<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\ManipulationUnit;

use Inspirum\Balikobot\Client\Request\Carrier;
use function array_map;

final class DefaultManipulationUnitFactory implements ManipulationUnitFactory
{
    /** @inheritDoc */
    public function create(array $data): ManipulationUnit
    {
        return new ManipulationUnit((string) $data['code'], $data['name']);
    }

    /** @inheritDoc */
    public function createCollection(Carrier $carrierType, array $data): ManipulationUnitCollection
    {
        return new ManipulationUnitCollection(
            $carrierType,
            array_map(fn(array $unit): ManipulationUnit => $this->create($unit), $data['units'] ?? []),
        );
    }
}
