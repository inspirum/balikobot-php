<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Package;

use Inspirum\Arrayable\Model;
use Inspirum\Balikobot\Model\WithCarrierId;

/**
 * @extends \Inspirum\Arrayable\Model<string,mixed>
 */
interface Package extends Model, WithCarrierId
{
    public function getPackageId(): string;

    public function getBatchId(): string;

    public function getTrackUrl(): ?string;

    public function getLabelUrl(): ?string;

    public function getCarrierIdSwap(): ?string;

    /**
     * @return array<string>
     */
    public function getPieces(): array;

    public function getFinalCarrierId(): ?string;

    public function getFinalTrackUrl(): ?string;

    public function getBarcode(): ?string;
}
