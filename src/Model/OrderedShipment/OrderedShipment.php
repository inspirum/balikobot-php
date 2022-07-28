<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\OrderedShipment;

use Inspirum\Arrayable\BaseModel;

/**
 * @extends \Inspirum\Arrayable\BaseModel<string,mixed>
 */
class OrderedShipment extends BaseModel
{
    /**
     * @param array<string> $packageIds
     */
    public function __construct(
        private string $orderId,
        private string $carrier,
        private array $packageIds,
        private string $handoverUrl,
        private string $labelsUrl,
        private ?string $fileUrl = null
    ) {
    }

    /** @inheritDoc */
    public function __toArray(): array
    {
        return [
            'carrier' => $this->carrier,
            'orderId' => $this->orderId,
            'packageIds' => $this->packageIds,
            'handoverUrl' => $this->handoverUrl,
            'labelsUrl' => $this->labelsUrl,
            'fileUrl' => $this->fileUrl,
        ];
    }
}
