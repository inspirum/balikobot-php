<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\PackageData\Package;

use Inspirum\Balikobot\Definitions\AttributeType;

trait ParcelData
{
    public function setWidth(float $width): void
    {
        $this->offsetSet(AttributeType::WIDTH, $width);
    }

    public function setLength(float $length): void
    {
        $this->offsetSet(AttributeType::LENGTH, $length);
    }

    public function setHeight(float $height): void
    {
        $this->offsetSet(AttributeType::HEIGHT, $height);
    }

    public function setWeight(float $weight): void
    {
        $this->offsetSet(AttributeType::WEIGHT, $weight);
    }

    public function setPrice(float $price): void
    {
        $this->offsetSet(AttributeType::PRICE, $price);
    }

    public function setVolume(float $volume): void
    {
        $this->offsetSet(AttributeType::VOLUME, $volume);
    }

    public function setOverDimension(bool $overDimension = true): void
    {
        $this->offsetSet(AttributeType::OVER_DIMENSION, (int) $overDimension);
    }

    public function setInsCurrency(string $currency): void
    {
        $this->offsetSet(AttributeType::INS_CURRENCY, $currency);
    }
}
