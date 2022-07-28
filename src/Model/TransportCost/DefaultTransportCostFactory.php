<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\TransportCost;

use function array_map;
use function array_values;

final class DefaultTransportCostFactory implements TransportCostFactory
{
    /** @inheritDoc */
    public function create(string $carrier, array $data): TransportCost
    {
        return new DefaultTransportCost(
            $data['eid'],
            $carrier,
            $data['costs_total'],
            $data['currency'],
            array_map(static fn(array $part) => new DefaultTransportCostPart($part['name'], $part['cost'], $data['currency']), $data['costs_breakdown'] ?? [])
        );
    }

    /** @inheritDoc */
    public function createCollection(string $carrier, array $data): TransportCostCollection
    {
        unset($data['status']);

//        $this->validator->validateIndexes($data, count($packages));

//        $this->validator->validateResponseItemHasAttribute($data, 'eid', $data);

        return new DefaultTransportCostCollection($carrier, array_values(array_map(fn(array $package): TransportCost => $this->create($carrier, $package), $data)));
    }
}
