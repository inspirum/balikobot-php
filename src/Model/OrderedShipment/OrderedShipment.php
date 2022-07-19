<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\OrderedShipment;

use Inspirum\Arrayable\BaseModel;
use Inspirum\Balikobot\Client\Request\CarrierType;

/**
 * @extends \Inspirum\Arrayable\BaseModel<string,mixed>
 */
class OrderedShipment extends BaseModel
{
    /**
     * @param array<string> $packageIds
     */
    public function __construct(
        public readonly string $orderId,
        public readonly CarrierType $carrier,
        public readonly array $packageIds,
        public readonly string $handoverUrl,
        public readonly string $labelsUrl,
        public readonly ?string $fileUrl = null
    ) {
    }

    /** @inheritDoc */
    public function __toArray(): array
    {
        return [
            'carrier' => $this->carrier->getValue(),
            'orderId' => $this->orderId,
            'packageIds' => $this->packageIds,
            'handoverUrl' => $this->handoverUrl,
            'labelsUrl' => $this->labelsUrl,
            'fileUrl' => $this->fileUrl,
        ];
    }
}
