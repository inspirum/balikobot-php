<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Status;

use Inspirum\Balikobot\Client\Request\CarrierType;

interface PackageStatusFactory
{
    /**
     * @param array<string,string|int|float> $data
     * @param array<mixed,mixed>             $response
     */
    public function create(CarrierType $carrier, string $carrierId, array $data, array $response = []): Status;

    /**
     * @param array<string,string|int|float> $data
     * @param array<mixed,mixed>             $response
     */
    public function createLastStatus(CarrierType $carrier, array $data, array $response = []): Status;

    /**
     * @param array<string>      $carrierIds
     * @param array<mixed,mixed> $data
     */
    public function createCollection(CarrierType $carrier, array $carrierIds, array $data): StatusesCollection;

    /**
     * @param array<string>      $carrierIds
     * @param array<mixed,mixed> $data
     */
    public function createLastStatusCollection(CarrierType $carrier, array $carrierIds, array $data): StatusCollection;
}
