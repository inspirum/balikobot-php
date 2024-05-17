<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\ProofOfDelivery;

interface ProofOfDeliveryFactory
{
    /**
     * @param array<string> $carrierIds
     * @param array<string,mixed> $data
     *
     * @return array<string>
     *
     * @throws \Inspirum\Balikobot\Exception\Exception
     */
    public function create(array $carrierIds, array $data): array;
}
