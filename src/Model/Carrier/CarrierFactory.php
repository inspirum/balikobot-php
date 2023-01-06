<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Carrier;

interface CarrierFactory
{
    /**
     * @param array<string,mixed> $data
     */
    public function create(string $carrier, array $data): Carrier;

    /**
     * @param array<array<int,mixed>> $data
     *
     * @return \Inspirum\Balikobot\Model\Carrier\CarrierCollection&array<\Inspirum\Balikobot\Model\Carrier\Carrier>
     */
    public function createCollection(array $data): CarrierCollection;
}
