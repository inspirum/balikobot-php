<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Status;

interface StatusFactory
{
    /**
     * @param array<string,string|int|float> $data
     * @param array<mixed,mixed>             $response
     */
    public function create(string $carrier, string $carrierId, array $data, array $response = []): Status;

    /**
     * @param array<string,string|int|float> $data
     * @param array<mixed,mixed>             $response
     */
    public function createLastStatus(string $carrier, array $data, array $response = []): Status;

    /**
     * @param array<string>      $carrierIds
     * @param array<mixed,mixed> $data
     */
    public function createCollection(string $carrier, array $carrierIds, array $data): StatusesCollection;

    /**
     * @param array<string>      $carrierIds
     * @param array<mixed,mixed> $data
     */
    public function createLastStatusCollection(string $carrier, array $carrierIds, array $data): StatusCollection;
}
