<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\TransportCost;

use Inspirum\Arrayable\Model;

/**
 * @extends \Inspirum\Arrayable\Model<string,mixed>
 */
interface TransportCost extends Model
{
    public function getBatchId(): string;

    public function getCarrier(): string;

    public function getTotalCost(): float;

    public function getCurrencyCode(): string;

    /**
     * @return array<\Inspirum\Balikobot\Model\TransportCost\TransportCostPart>
     */
    public function getCostsBreakdown(): array;
}
