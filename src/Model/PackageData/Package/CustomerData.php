<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\PackageData\Package;

use Inspirum\Balikobot\Definitions\Option;

trait CustomerData
{
    public function setRecName(string $name): void
    {
        $this->offsetSet(Option::REC_NAME, $name);
    }

    public function setRecFirm(string $firm): void
    {
        $this->offsetSet(Option::REC_FIRM, $firm);
    }

    public function setRecStreet(string $street): void
    {
        $this->offsetSet(Option::REC_STREET, $street);
    }

    public function setRecCity(string $city): void
    {
        $this->offsetSet(Option::REC_CITY, $city);
    }

    public function setRecZip(string $zip): void
    {
        $this->offsetSet(Option::REC_ZIP, $zip);
    }

    public function setRecRegion(string $recRegion): void
    {
        $this->offsetSet(Option::REC_REGION, $recRegion);
    }

    public function setRecCountry(string $country): void
    {
        $this->offsetSet(Option::REC_COUNTRY, $country);
    }

    public function setRecLocaleId(string $localeId): void
    {
        $this->offsetSet(Option::REC_LOCALE_ID, $localeId);
    }

    public function setRecEmail(string $email): void
    {
        $this->offsetSet(Option::REC_EMAIL, $email);
    }

    public function setRecPhone(string $phone): void
    {
        $this->offsetSet(Option::REC_PHONE, $phone);
    }

    public function setBankAccountNumber(string $bankAccount): void
    {
        $this->offsetSet(Option::BANK_ACCOUNT_NUMBER, $bankAccount);
    }

    public function setBankCode(string $bankCode): void
    {
        $this->offsetSet(Option::BANK_CODE, $bankCode);
    }

    public function setRecNamePatronymum(string $recNamePatronymum): void
    {
        $this->offsetSet(Option::REC_NAME_PATRONYMUM, $recNamePatronymum);
    }

    public function setRecId(string $id): void
    {
        $this->offsetSet(Option::REC_ID, $id);
    }
}
