<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\PackageData\Package;

use Inspirum\Balikobot\Definitions\Attribute;

trait SenCustomerData
{
    public function setSenName(string $name): void
    {
        $this->offsetSet(Attribute::SEN_NAME, $name);
    }

    public function setSenFirm(string $firm): void
    {
        $this->offsetSet(Attribute::SEN_FIRM, $firm);
    }

    public function setSenStreet(string $street): void
    {
        $this->offsetSet(Attribute::SEN_STREET, $street);
    }

    public function setSenStreetAppend(string $street): void
    {
        $this->offsetSet(Attribute::SEN_STREET_APPEND, $street);
    }

    public function setSenCity(string $city): void
    {
        $this->offsetSet(Attribute::SEN_CITY, $city);
    }

    public function setSenZip(string $zip): void
    {
        $this->offsetSet(Attribute::SEN_ZIP, $zip);
    }

    public function setSenCountry(string $country): void
    {
        $this->offsetSet(Attribute::SEN_COUNTRY, $country);
    }

    public function setSenEmail(string $email): void
    {
        $this->offsetSet(Attribute::SEN_EMAIL, $email);
    }

    public function setSenPhone(string $phone): void
    {
        $this->offsetSet(Attribute::SEN_PHONE, $phone);
    }
}
