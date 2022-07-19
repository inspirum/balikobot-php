<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model;

use Inspirum\Balikobot\Client\Request\CarrierType;

/**
 * @template T of \Inspirum\Balikobot\Model\WithCarrierId
 */
interface PerCarrierCollection
{
    public function getCarrier(): CarrierType;

    /**
     * @return T|null
     */
    public function getForCarrierId(string $carrierId): ?WithCarrierId;

    /**
     * @return array<string>
     */
    public function getCarrierIds(): array;
}
