<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\TransportCost;

use Inspirum\Balikobot\Client\Request\CarrierType;
use function array_map;

final class DefaultTransportCostFactory implements TransportCostFactory
{
    /** @inheritDoc */
    public function create(CarrierType $carrier, array $data): TransportCost
    {
        return new TransportCost(
            $data['eid'],
            $carrier,
            $data['costs_total'],
            $data['currency'],
            array_map(static fn(array $part) => new TransportCostPart($part['name'], $part['cost'], $data['currency']), $data['costs_breakdown'] ?? [])
        );
    }

    /** @inheritDoc */
    public function createCollection(CarrierType $carrier, array $data): TransportCostCollection
    {
        unset($data['status']);

//        $this->validator->validateIndexes($data, count($packages));

//        $this->validator->validateResponseItemHasAttribute($data, 'eid', $data);

        $transportCosts = new TransportCostCollection($carrier);

        foreach ($data as $package) {
            $transportCost = $this->create($carrier, $package);
            $transportCosts->offsetAdd($transportCost);
        }

        return $transportCosts;
    }
}
