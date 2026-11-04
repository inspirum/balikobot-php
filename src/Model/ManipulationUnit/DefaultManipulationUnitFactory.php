<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\ManipulationUnit;

use function array_map;

final class DefaultManipulationUnitFactory implements ManipulationUnitFactory
{
    /** @inheritDoc */
    public function create(array $data): ManipulationUnit
    {
        return new DefaultManipulationUnit((string) $data['code'], $data['name']);
    }

    /** @inheritDoc */
    public function createCollection(string $carrier, array $data): ManipulationUnitCollection
    {
        return new DefaultManipulationUnitCollection(
            $carrier,
            array_map(fn (array $unit): ManipulationUnit => $this->create($unit), $data['units'] ?? []),
        );
    }
}
