<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\TransportCost;

use Inspirum\Arrayable\BaseModel;
use Inspirum\Balikobot\Client\Request\CarrierType;

/**
 * @extends \Inspirum\Arrayable\BaseModel<string,mixed>
 */
class TransportCost extends BaseModel
{
    /**
     * @param array<\Inspirum\Balikobot\Model\TransportCost\TransportCostPart> $costsBreakdown
     */
    public function __construct(
        public readonly string $batchId,
        public readonly CarrierType $carrier,
        public readonly float $totalCost,
        public readonly string $currencyCode,
        public readonly array $costsBreakdown = []
    ) {
    }

    /**
     * @return array<string,mixed>
     */
    public function __toArray(): array
    {
        return [
            'batchId'        => $this->batchId,
            'carrier'        => $this->carrier->getValue(),
            'totalCost'      => $this->totalCost,
            'currencyCode'   => $this->currencyCode,
            'costsBreakdown' => $this->costsBreakdown,
        ];
    }
}
