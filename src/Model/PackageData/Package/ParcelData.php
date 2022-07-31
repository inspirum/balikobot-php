<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\PackageData\Package;

use Inspirum\Balikobot\Definitions\Option;

trait ParcelData
{
    public function setWidth(float $width): void
    {
        $this->offsetSet(Option::WIDTH, $width);
    }

    public function setLength(float $length): void
    {
        $this->offsetSet(Option::LENGTH, $length);
    }

    public function setHeight(float $height): void
    {
        $this->offsetSet(Option::HEIGHT, $height);
    }

    public function setWeight(float $weight): void
    {
        $this->offsetSet(Option::WEIGHT, $weight);
    }

    public function setPrice(float $price): void
    {
        $this->offsetSet(Option::PRICE, $price);
    }

    public function setVolume(float $volume): void
    {
        $this->offsetSet(Option::VOLUME, $volume);
    }

    public function setOverDimension(bool $overDimension = true): void
    {
        $this->offsetSet(Option::OVER_DIMENSION, (int) $overDimension);
    }

    public function setInsCurrency(string $currency): void
    {
        $this->offsetSet(Option::INS_CURRENCY, $currency);
    }
}
