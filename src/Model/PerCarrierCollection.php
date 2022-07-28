<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model;

/**
 * @template T of \Inspirum\Balikobot\Model\WithCarrierId
 */
interface PerCarrierCollection
{
    public function getCarrier(): string;

    /**
     * @return T|null
     */
    public function getForCarrierId(string $carrierId): ?WithCarrierId;

    /**
     * @return array<string>
     */
    public function getCarrierIds(): array;
}
