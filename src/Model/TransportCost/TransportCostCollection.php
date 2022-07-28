<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\TransportCost;

use Inspirum\Arrayable\Collection;

/**
 * @extends \Inspirum\Arrayable\Collection<string,mixed,int,\Inspirum\Balikobot\Model\TransportCost\TransportCost>
 */
interface TransportCostCollection extends Collection
{
    public function getCarrier(): string;

    /**
     * @return array<int,\Inspirum\Balikobot\Model\TransportCost\TransportCost>
     */
    public function getCosts(): array;

    /**
     * @return array<string>
     */
    public function getBatchIds(): array;

    public function getTotalCost(): float;

    public function getCurrencyCode(): string;
}
