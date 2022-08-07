<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\PackageData\Package;

use Inspirum\Balikobot\Definitions\Attribute;

trait NeutralizeData
{
    public function setNeutralize(bool $value = true): void
    {
        $this->offsetSet(Attribute::NEUTRALIZE, (int) $value);
    }

    public function setNeutralizeName(string $value): void
    {
        $this->offsetSet(Attribute::NEUTRALIZE_NAME, $value);
    }

    public function setNeutralizeFirm(string $value): void
    {
        $this->offsetSet(Attribute::NEUTRALIZE_FIRM, $value);
    }

    public function setNeutralizeStreet(string $value): void
    {
        $this->offsetSet(Attribute::NEUTRALIZE_STREET, $value);
    }

    public function setNeutralizeCity(string $value): void
    {
        $this->offsetSet(Attribute::NEUTRALIZE_CITY, $value);
    }

    public function setNeutralizeZip(string $value): void
    {
        $this->offsetSet(Attribute::NEUTRALIZE_ZIP, $value);
    }

    public function setNeutralizeCountry(string $value): void
    {
        $this->offsetSet(Attribute::NEUTRALIZE_COUNTRY, $value);
    }

    public function setNeutralizeRegion(string $value): void
    {
        $this->offsetSet(Attribute::NEUTRALIZE_REGION, $value);
    }

    public function setNeutralizePhone(string $value): void
    {
        $this->offsetSet(Attribute::NEUTRALIZE_PHONE, $value);
    }

    public function setNeutralizeEmail(string $value): void
    {
        $this->offsetSet(Attribute::NEUTRALIZE_EMAIL, $value);
    }

    public function setNeutralizeAccountNumber(string $value): void
    {
        $this->offsetSet(Attribute::NEUTRALIZE_ACCOUNT_NUMBER, $value);
    }
}
