<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Package;

use Inspirum\Arrayable\BaseModel;
use Inspirum\Balikobot\Model\WithCarrierId;

/**
 * @extends \Inspirum\Arrayable\BaseModel<string,mixed>
 */
class Package extends BaseModel implements WithCarrierId
{
    /**
     * @param array<string> $pieces
     */
    public function __construct(
        private string $carrier,
        private string $packageId,
        private string $batchId,
        private string $carrierId,
        private ?string $trackUrl = null,
        private ?string $labelUrl = null,
        private ?string $carrierIdSwap = null,
        private array $pieces = [],
        private ?string $finalCarrierId = null,
        private ?string $finalTrackUrl = null,
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
     * @return array<string>
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
            'carrier'        => $this->carrier,
            'carrierId'      => $this->carrierId,
            'packageId'      => $this->packageId,
            'batchId'        => $this->batchId,
            'trackUrl'       => $this->trackUrl,
            'labelUrl'       => $this->labelUrl,
            'carrierIdSwap'  => $this->carrierIdSwap,
            'pieces'         => $this->pieces,
            'finalCarrierId' => $this->finalCarrierId,
            'finalTrackUrl'  => $this->finalTrackUrl,
        ];
    }
}
