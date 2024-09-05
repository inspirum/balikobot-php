<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\TransportCost;

use Inspirum\Arrayable\BaseModel;
use function array_map;

/**
 * @extends \Inspirum\Arrayable\BaseModel<string,mixed>
 */
final class DefaultTransportCost extends BaseModel implements TransportCost
{
    /**
     * @param array<\Inspirum\Balikobot\Model\TransportCost\TransportCostPart> $costsBreakdown
     */
    public function __construct(
        private readonly string $batchId,
        private readonly string $carrier,
        private readonly float $totalCost,
        private readonly string $currencyCode,
        private readonly array $costsBreakdown = [],
    ) {
    }

    public function getBatchId(): string
    {
        return $this->batchId;
    }

    public function getCarrier(): string
    {
        return $this->carrier;
    }

    public function getTotalCost(): float
    {
        return $this->totalCost;
    }

    public function getCurrencyCode(): string
    {
        return $this->currencyCode;
    }

    /** @inheritDoc */
    public function getCostsBreakdown(): array
    {
        return $this->costsBreakdown;
    }

    /**
     * @return array<string,mixed>
     */
    public function __toArray(): array
    {
        return [
            'batchId' => $this->batchId,
            'carrier' => $this->carrier,
            'totalCost' => $this->totalCost,
            'currencyCode' => $this->currencyCode,
            'costsBreakdown' => array_map(static fn (TransportCostPart $costPart): array => $costPart->__toArray(), $this->costsBreakdown),
        ];
    }
}
