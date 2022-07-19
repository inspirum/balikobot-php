<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Package;

use Inspirum\Arrayable\BaseModel;
use Inspirum\Balikobot\Client\Request\CarrierType;
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
        public readonly CarrierType $carrier,
        public readonly string $packageId,
        public readonly string $batchId,
        public readonly string $carrierId,
        public readonly ?string $trackUrl = null,
        public readonly ?string $labelUrl = null,
        public readonly ?string $carrierIdSwap = null,
        public readonly array $pieces = [],
        public readonly ?string $finalCarrierId = null,
        public readonly ?string $finalTrackUrl = null,
    ) {
    }

    public function getCarrier(): CarrierType
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
            'carrier'        => $this->carrier->getValue(),
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
