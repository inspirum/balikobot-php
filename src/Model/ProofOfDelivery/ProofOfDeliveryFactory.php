<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\ProofOfDelivery;

interface ProofOfDeliveryFactory
{
    /**
     * @param list<string> $carrierIds
     * @param array<string,mixed> $data
     *
     * @return list<string>
     *
     * @throws \Inspirum\Balikobot\Exception\Exception
     */
    public function create(array $carrierIds, array $data): array;
}
