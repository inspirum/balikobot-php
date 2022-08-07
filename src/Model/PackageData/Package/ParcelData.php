<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\PackageData\Package;

use Inspirum\Balikobot\Definitions\Attribute;

trait ParcelData
{
    public function setWidth(float $width): void
    {
        $this->offsetSet(Attribute::WIDTH, $width);
    }

    public function setLength(float $length): void
    {
        $this->offsetSet(Attribute::LENGTH, $length);
    }

    public function setHeight(float $height): void
    {
        $this->offsetSet(Attribute::HEIGHT, $height);
    }

    public function setWeight(float $weight): void
    {
        $this->offsetSet(Attribute::WEIGHT, $weight);
    }

    public function setPrice(float $price): void
    {
        $this->offsetSet(Attribute::PRICE, $price);
    }

    public function setVolume(float $volume): void
    {
        $this->offsetSet(Attribute::VOLUME, $volume);
    }

    public function setOverDimension(bool $overDimension = true): void
    {
        $this->offsetSet(Attribute::OVER_DIMENSION, (int) $overDimension);
    }

    public function setInsCurrency(string $currency): void
    {
        $this->offsetSet(Attribute::INS_CURRENCY, $currency);
    }

    public function setSize(string $size): void
    {
        $this->offsetSet(Attribute::SIZE, $size);
    }

    public function setLoadingLengthPallets(float $length): void
    {
        $this->offsetSet(Attribute::LOADING_LENGTH_PALLETS, $length);
    }

    public function setTransformTempFrom(float $temp): void
    {
        $this->offsetSet(Attribute::TRANSFORM_TEMP_FROM, $temp);
    }

    public function setTransformTempTo(float $temp): void
    {
        $this->offsetSet(Attribute::TRANSFORM_TEMP_TO, $temp);
    }
}
