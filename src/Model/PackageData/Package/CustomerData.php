<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\PackageData\Package;

use Inspirum\Balikobot\Definitions\Attribute;

trait CustomerData
{
    public function setRecName(string $name): void
    {
        $this->offsetSet(Attribute::REC_NAME, $name);
    }

    public function setRecFirm(string $firm): void
    {
        $this->offsetSet(Attribute::REC_FIRM, $firm);
    }

    public function setRecStreet(string $street): void
    {
        $this->offsetSet(Attribute::REC_STREET, $street);
    }

    public function setRecStreetAppend(string $street): void
    {
        $this->offsetSet(Attribute::REC_STREET_APPEND, $street);
    }

    public function setRecCity(string $city): void
    {
        $this->offsetSet(Attribute::REC_CITY, $city);
    }

    public function setRecZip(string $zip): void
    {
        $this->offsetSet(Attribute::REC_ZIP, $zip);
    }

    public function setRecRegion(string $recRegion): void
    {
        $this->offsetSet(Attribute::REC_REGION, $recRegion);
    }

    public function setRecCountry(string $country): void
    {
        $this->offsetSet(Attribute::REC_COUNTRY, $country);
    }

    public function setRecLocaleId(string $localeId): void
    {
        $this->offsetSet(Attribute::REC_LOCALE_ID, $localeId);
    }

    public function setRecEmail(string $email): void
    {
        $this->offsetSet(Attribute::REC_EMAIL, $email);
    }

    public function setRecPhone(string $phone): void
    {
        $this->offsetSet(Attribute::REC_PHONE, $phone);
    }

    public function setBankAccountNumber(string $bankAccountNumber): void
    {
        $this->offsetSet(Attribute::BANK_ACCOUNT_NUMBER, $bankAccountNumber);
    }

    public function setBankCode(string $bankCode): void
    {
        $this->offsetSet(Attribute::BANK_CODE, $bankCode);
    }

    public function setBankName(string $bankName): void
    {
        $this->offsetSet(Attribute::BANK_NAME, $bankName);
    }

    public function setBankAccountHolder(string $bankAccountHolder): void
    {
        $this->offsetSet(Attribute::BANK_ACCOUNT_HOLDER, $bankAccountHolder);
    }

    public function setBankAccountName(string $bankAccountName): void
    {
        $this->offsetSet(Attribute::BANK_ACCOUNT_NAME, $bankAccountName);
    }

    public function setRecNamePatronymum(string $recNamePatronymum): void
    {
        $this->offsetSet(Attribute::REC_NAME_PATRONYMUM, $recNamePatronymum);
    }

    public function setRecId(string $id): void
    {
        $this->offsetSet(Attribute::REC_ID, $id);
    }

    public function setPayer(string $payer): void
    {
        $this->offsetSet(Attribute::PAYER, $payer);
    }
}
