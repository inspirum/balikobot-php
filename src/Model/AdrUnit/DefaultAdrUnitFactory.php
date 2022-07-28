<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\AdrUnit;

use function array_map;

final class DefaultAdrUnitFactory implements AdrUnitFactory
{
    /** @inheritDoc */
    public function create(string $carrier, array $data): AdrUnit
    {
        return new DefaultAdrUnit(
            $carrier,
            $data['id'],
            $data['code'],
            $data['name'],
            $data['class'],
            $data['packaging'],
            $data['tunnel_code'],
            $data['transport_category'],
        );
    }

    /** @inheritDoc */
    public function createCollection(string $carrier, array $data): AdrUnitCollection
    {
        return new DefaultAdrUnitCollection(
            $carrier,
            array_map(fn(array $unit): AdrUnit => $this->create($carrier, $unit), $data['units'] ?? []),
        );
    }
}
