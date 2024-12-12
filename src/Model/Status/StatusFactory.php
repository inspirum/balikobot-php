<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Status;

interface StatusFactory
{
    /**
     * @param array<string,mixed> $data
     * @param array<mixed,mixed> $response
     */
    public function create(string $carrier, string $carrierId, array $data, array $response = []): Status;

    /**
     * @param array<string,mixed> $data
     * @param array<mixed,mixed> $response
     *
     * @throws \Inspirum\Balikobot\Exception\Exception
     */
    public function createLastStatus(string $carrier, array $data, array $response = []): Status;

    /**
     * @param list<string> $carrierIds
     * @param array<mixed,mixed> $data
     *
     * @throws \Inspirum\Balikobot\Exception\Exception
     */
    public function createCollection(string $carrier, array $carrierIds, array $data): StatusesCollection;

    /**
     * @param list<string> $carrierIds
     * @param array<mixed,mixed> $data
     *
     * @throws \Inspirum\Balikobot\Exception\Exception
     */
    public function createLastStatusCollection(string $carrier, array $carrierIds, array $data): StatusCollection;
}
