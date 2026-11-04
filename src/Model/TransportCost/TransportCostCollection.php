<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\TransportCost;

use Inspirum\Arrayable\ListCollection;

/**
 * @extends \Inspirum\Arrayable\ListCollection<string,mixed,\Inspirum\Balikobot\Model\TransportCost\TransportCost>
 */
interface TransportCostCollection extends ListCollection
{
    public function getCarrier(): string;

    /**
     * @return list<\Inspirum\Balikobot\Model\TransportCost\TransportCost>
     */
    public function getCosts(): array;

    /**
     * @return list<string>
     */
    public function getBatchIds(): array;

    public function getTotalCost(): float;

    public function getCurrencyCode(): string;
}
