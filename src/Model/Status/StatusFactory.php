<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Status;

use Inspirum\Balikobot\Client\Request\Carrier;

interface StatusFactory
{
    /**
     * @param array<string,string|int|float> $data
     * @param array<mixed,mixed>             $response
     */
    public function create(Carrier $carrier, string $carrierId, array $data, array $response = []): Status;

    /**
     * @param array<string,string|int|float> $data
     * @param array<mixed,mixed>             $response
     */
    public function createLastStatus(Carrier $carrier, array $data, array $response = []): Status;

    /**
     * @param array<string>      $carrierIds
     * @param array<mixed,mixed> $data
     */
    public function createCollection(Carrier $carrier, array $carrierIds, array $data): StatusesCollection;

    /**
     * @param array<string>      $carrierIds
     * @param array<mixed,mixed> $data
     */
    public function createLastStatusCollection(Carrier $carrier, array $carrierIds, array $data): StatusCollection;
}
