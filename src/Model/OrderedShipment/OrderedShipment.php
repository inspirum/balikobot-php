<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\OrderedShipment;

use Inspirum\Arrayable\Model;

/**
 * @extends \Inspirum\Arrayable\Model<string,mixed>
 */
interface OrderedShipment extends Model
{
    public function getOrderId(): string;

    public function getCarrier(): string;

    /**
     * @return list<string>
     */
    public function getPackageIds(): array;

    public function getHandoverUrl(): string;

    public function getLabelsUrl(): string;

    public function getFileUrl(): ?string;
}
