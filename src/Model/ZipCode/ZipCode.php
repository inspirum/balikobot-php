<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\ZipCode;

use Inspirum\Arrayable\Model;

/**
 * @extends \Inspirum\Arrayable\Model<string,mixed>
 */
interface ZipCode extends Model
{
    public function getCarrier(): string;

    public function getService(): ?string;

    public function getZipCode(): ?string;

    public function getZipCodeEnd(): ?string;

    public function getCity(): ?string;

    public function getRegion(): ?string;

    public function getCountry(): ?string;

    public function isMorningDelivery(): bool;
}
