<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Package;

use Inspirum\Arrayable\BaseModel;

/**
 * @extends \Inspirum\Arrayable\BaseModel<string,mixed>
 */
final class DefaultPackage extends BaseModel implements Package
{
    /**
     * @param list<string> $pieces
     */
    public function __construct(
        private readonly string $carrier,
        private readonly string $packageId,
        private readonly string $batchId,
        private readonly string $carrierId,
        private readonly ?string $trackUrl = null,
        private readonly ?string $labelUrl = null,
        private readonly ?string $carrierIdSwap = null,
        private readonly array $pieces = [],
        private readonly ?string $finalCarrierId = null,
        private readonly ?string $finalTrackUrl = null,
        private readonly ?string $barcode = null,
    ) {
    }

    public function getPackageId(): string
    {
        return $this->packageId;
    }

    public function getBatchId(): string
    {
        return $this->batchId;
    }

    public function getTrackUrl(): ?string
    {
        return $this->trackUrl;
    }

    public function getLabelUrl(): ?string
    {
        return $this->labelUrl;
    }

    public function getCarrierIdSwap(): ?string
    {
        return $this->carrierIdSwap;
    }

    /**
     * @return list<string>
     */
    public function getPieces(): array
    {
        return $this->pieces;
    }

    public function getFinalCarrierId(): ?string
    {
        return $this->finalCarrierId;
    }

    public function getFinalTrackUrl(): ?string
    {
        return $this->finalTrackUrl;
    }

    public function getBarcode(): ?string
    {
        return $this->barcode;
    }

    public function getCarrier(): string
    {
        return $this->carrier;
    }

    public function getCarrierId(): string
    {
        return $this->carrierId;
    }

    /** @inheritDoc */
    public function __toArray(): array
    {
        return [
            'carrier' => $this->carrier,
            'carrierId' => $this->carrierId,
            'packageId' => $this->packageId,
            'batchId' => $this->batchId,
            'trackUrl' => $this->trackUrl,
            'labelUrl' => $this->labelUrl,
            'carrierIdSwap' => $this->carrierIdSwap,
            'pieces' => $this->pieces,
            'finalCarrierId' => $this->finalCarrierId,
            'finalTrackUrl' => $this->finalTrackUrl,
            'barcode' => $this->barcode,
        ];
    }
}
