<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\TransportCost;

use Inspirum\Balikobot\Client\Response\Validator;
use function array_filter;
use function array_map;
use function array_values;
use function count;
use function is_int;
use const ARRAY_FILTER_USE_KEY;

final class DefaultTransportCostFactory implements TransportCostFactory
{
    public function __construct(
        private readonly Validator $validator,
    ) {
    }

    /** @inheritDoc */
    public function create(string $carrier, array $data): TransportCost
    {
        return new DefaultTransportCost(
            $data['eid'],
            $carrier,
            $data['costs_total'],
            $data['currency'],
            array_map(static fn (array $part) => new DefaultTransportCostPart($part['name'], $part['cost'], $data['currency']), $data['costs_breakdown'] ?? []),
        );
    }

    /** @inheritDoc */
    public function createCollection(string $carrier, ?array $packages, array $data): TransportCostCollection
    {
        $packagesResponse = $data['packages'] ?? array_filter($data, is_int(...), ARRAY_FILTER_USE_KEY);

        if ($packages !== null) {
            $this->validator->validateIndexes($packagesResponse, count($packages));
        }

        foreach ($packagesResponse as $package) {
            $this->validator->validateResponseStatus($package, $data, false);
            $this->validator->validateResponseItemHasAttribute($package, 'eid', $data);
        }

        return new DefaultTransportCostCollection($carrier, array_values(array_map(fn (array $package): TransportCost => $this->create($carrier, $package), $packagesResponse)));
    }
}
