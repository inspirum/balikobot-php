<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Values\Package;

use Inspirum\Balikobot\Definitions\Option;

trait CustomerData
{
    /**
     * Set the item at a given offset
     *
     * @param string $key
     * @param mixed  $value
     *
     * @return void
     */
    abstract public function offsetSet($key, $value): void;

    /**
     * @param string $name
     *
     * @return void
     */
    public function setRecName(string $name): void
    {
        $this->offsetSet(Option::REC_NAME, $name);
    }

    /**
     * @param string $firm
     *
     * @return void
     */
    public function setRecFirm(string $firm): void
    {
        $this->offsetSet(Option::REC_FIRM, $firm);
    }

    /**
     * @param string $street
     *
     * @return void
     */
    public function setRecStreet(string $street): void
    {
        $this->offsetSet(Option::REC_STREET, $street);
    }

    /**
     * @param string $city
     *
     * @return void
     */
    public function setRecCity(string $city): void
    {
        $this->offsetSet(Option::REC_CITY, $city);
    }

    /**
     * @param string $zip
     *
     * @return void
     */
    public function setRecZip(string $zip): void
    {
        $this->offsetSet(Option::REC_ZIP, $zip);
    }

    /**
     * @param string $recRegion
     *
     * @return void
     */
    public function setRecRegion(string $recRegion): void
    {
        $this->offsetSet(Option::REC_REGION, $recRegion);
    }

    /**
     * @param string $country
     *
     * @return void
     */
    public function setRecCountry(string $country): void
    {
        $this->offsetSet(Option::REC_COUNTRY, $country);
    }

    /**
     * @param string $localeId
     *
     * @return void
     */
    public function setRecLocaleId(string $localeId): void
    {
        $this->offsetSet(Option::REC_LOCALE_ID, $localeId);
    }

    /**
     * @param string $email
     *
     * @return void
     */
    public function setRecEmail(string $email): void
    {
        $this->offsetSet(Option::REC_EMAIL, $email);
    }

    /**
     * @param string $phone
     *
     * @return void
     */
    public function setRecPhone(string $phone): void
    {
        $this->offsetSet(Option::REC_PHONE, $phone);
    }

    /**
     * @param string $bankAccount
     *
     * @return void
     */
    public function setBankAccountNumber(string $bankAccount): void
    {
        $this->offsetSet(Option::BANK_ACCOUNT_NUMBER, $bankAccount);
    }

    /**
     * @param string $bankCode
     *
     * @return void
     */
    public function setBankCode(string $bankCode): void
    {
        $this->offsetSet(Option::BANK_CODE, $bankCode);
    }

    /**
     * @param string $recNamePatronymum
     *
     * @return void
     */
    public function setRecNamePatronymum(string $recNamePatronymum): void
    {
        $this->offsetSet(Option::REC_NAME_PATRONYMUM, $recNamePatronymum);
    }

    /**
     * @param string $id
     *
     * @return void
     */
    public function setRecId(string $id): void
    {
        $this->offsetSet(Option::REC_ID, $id);
    }
}
