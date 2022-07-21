<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\AdrUnit;

use Inspirum\Balikobot\Client\Request\Carrier;
use function array_map;

final class DefaultAdrUnitFactory implements AdrUnitFactory
{
    /** @inheritDoc */
    public function create(Carrier $carrier, array $data): AdrUnit
    {
        return new AdrUnit(
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
    public function createCollection(Carrier $carrier, array $data): AdrUnitCollection
    {
        return new AdrUnitCollection(
            $carrier,
            array_map(fn(array $unit): AdrUnit => $this->create($carrier, $unit), $data['units'] ?? []),
        );
    }
}
