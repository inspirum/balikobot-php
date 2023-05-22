<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Values;

use function array_map;

class PackageTransportCost
{
    /**
     * Package batch ID (EID)
     *
     * @var string
     */
    private string $batchId;

    /**
     * Shipper
     *
     * @var string
     */
    private string $shipper;

    /**
     * Total cost
     *
     * @var float
     */
    private float $totalCost;

    /**
     * Currency code
     *
     * @var string
     */
    private string $currencyCode;

    /**
     * Cost breakdown
     *
     * @var array<\Inspirum\Balikobot\Model\Values\PackageTransportCostPart>
     */
    private array $costsBreakdown;

    /**
     * PackageTransportCost constructor
     *
     * @param string                                                           $batchId
     * @param string                                                           $shipper
     * @param float                                                            $totalCost
     * @param string                                                           $currencyCode
     * @param array<\Inspirum\Balikobot\Model\Values\PackageTransportCostPart> $costsBreakdown
     */
    public function __construct(
        string $batchId,
        string $shipper,
        float $totalCost,
        string $currencyCode,
        array $costsBreakdown = []
    ) {
        $this->batchId        = $batchId;
        $this->shipper        = $shipper;
        $this->totalCost      = $totalCost;
        $this->currencyCode   = $currencyCode;
        $this->costsBreakdown = $costsBreakdown;
    }

    /**
     * @return string
     */
    public function getBatchId(): string
    {
        return $this->batchId;
    }

    /**
     * @return string
     */
    public function getShipper(): string
    {
        return $this->shipper;
    }

    /**
     * @return float
     */
    public function getTotalCost(): float
    {
        return $this->totalCost;
    }

    /**
     * @return string
     */
    public function getCurrencyCode(): string
    {
        return $this->currencyCode;
    }

    /**
     * @return array<\Inspirum\Balikobot\Model\Values\PackageTransportCostPart>
     */
    public function getCostsBreakdown(): array
    {
        return $this->costsBreakdown;
    }

    /**
     * @param string              $shipper
     * @param array<string,mixed> $data
     *
     * @return \Inspirum\Balikobot\Model\Values\PackageTransportCost
     */
    public static function newInstanceFromData(string $shipper, array $data): self
    {
        return new self(
            $data['eid'],
            $shipper,
            $data['costs_total'],
            $data['currency'],
            array_map(static fn(array $part) => new PackageTransportCostPart($part['name'], $part['cost'], $data['currency']), $data['costs_breakdown'] ?? [])
        );
    }
}
