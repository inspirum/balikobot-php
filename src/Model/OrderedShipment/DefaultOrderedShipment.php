<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\OrderedShipment;

use Inspirum\Arrayable\BaseModel;

/**
 * @extends \Inspirum\Arrayable\BaseModel<string,mixed>
 */
final class DefaultOrderedShipment extends BaseModel implements OrderedShipment
{
    /**
     * @param array<string> $packageIds
     */
    public function __construct(
        private readonly string $orderId,
        private readonly string $carrier,
        private readonly array $packageIds,
        private readonly string $handoverUrl,
        private readonly string $labelsUrl,
        private readonly ?string $fileUrl = null,
    ) {
    }

    public function getOrderId(): string
    {
        return $this->orderId;
    }

    public function getCarrier(): string
    {
        return $this->carrier;
    }

    /** @inheritDoc */
    public function getPackageIds(): array
    {
        return $this->packageIds;
    }

    public function getHandoverUrl(): string
    {
        return $this->handoverUrl;
    }

    public function getLabelsUrl(): string
    {
        return $this->labelsUrl;
    }

    public function getFileUrl(): ?string
    {
        return $this->fileUrl;
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
