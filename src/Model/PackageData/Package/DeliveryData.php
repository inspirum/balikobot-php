<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\PackageData\Package;

use DateTimeInterface;
use Inspirum\Balikobot\Definitions\Attribute;

trait DeliveryData
{
    public function setNoteDriver(string $noteDriver): void
    {
        $this->offsetSet(Attribute::NOTE_DRIVER, $noteDriver);
    }

    public function setNoteCustomer(string $noteCustomer): void
    {
        $this->offsetSet(Attribute::NOTE_CUSTOMER, $noteCustomer);
    }

    public function setComfortExclusiveService(bool $comfortExclusiveService = true): void
    {
        $this->offsetSet(Attribute::COMFORT_EXCLUSIVE_SERVICE, (int) $comfortExclusiveService);
    }

    public function setPersDeliveryFloor(bool $persDeliveryFloor = true): void
    {
        $this->offsetSet(Attribute::PERS_DELIVERY_FLOOR, (int) $persDeliveryFloor);
    }

    public function setPersDeliveryBuilding(bool $persDeliveryBuilding = true): void
    {
        $this->offsetSet(Attribute::PERS_DELIVERY_BUILDING, (int) $persDeliveryBuilding);
    }

    public function setPersDeliveryDepartment(bool $persDeliveryDepartment = true): void
    {
        $this->offsetSet(Attribute::PERS_DELIVERY_DEPARTMENT, (int) $persDeliveryDepartment);
    }

    public function setPIN(string $pin): void
    {
        $this->offsetSet(Attribute::PIN, $pin);
    }

    public function setSatDelivery(bool $satDelivery = true): void
    {
        $this->offsetSet(Attribute::SAT_DELIVERY, (int) $satDelivery);
    }

    public function setRequireFullAge(bool $requireFullAge = true): void
    {
        $this->offsetSet(Attribute::REQUIRE_FULL_AGE, (int) $requireFullAge);
    }

    public function setFullAgeMinimum(string $fullAgeMinimum): void
    {
        $this->offsetSet(Attribute::FULL_AGE_MINIMUM, $fullAgeMinimum);
    }

    public function setFullAgeData(string $fullAgeData): void
    {
        $this->offsetSet(Attribute::FULL_AGE_DATA, $fullAgeData);
    }

    public function setPassword(string $password): void
    {
        $this->offsetSet(Attribute::PASSWORD, $password);
    }

    public function setDelInsurance(bool $delInsurance = true): void
    {
        $this->offsetSet(Attribute::DEL_INSURANCE, (int) $delInsurance);
    }

    public function setDelEvening(bool $delEvening = true): void
    {
        $this->offsetSet(Attribute::DEL_EVENING, (int) $delEvening);
    }

    /**
     * @param bool $delExworks
     *
     * @return void
     */
    public function setDelExworks(bool $delExworks = true): void
    {
        $this->offsetSet(Attribute::DEL_EXWORKS, (int) $delExworks);
    }

    public function setDelAccountNumber(string $delAccountNumber): void
    {
        $this->offsetSet(Attribute::DEL_EXWORKS_ACCOUNT_NUMBER, $delAccountNumber);
    }

    public function setDelZip(string $delZip): void
    {
        $this->offsetSet(Attribute::DEL_EXWORKS_ZIP, $delZip);
    }

    public function setDelCountryCode(string $countryCode): void
    {
        $this->offsetSet(Attribute::DEL_EXWORKS_COUNTRY_CODE, $countryCode);
    }

    public function setComfortService(bool $comfort = true): void
    {
        $this->offsetSet(Attribute::COMFORT_SERVICE, (int) $comfort);
    }

    public function setComfortServicePlus(bool $comfort = true): void
    {
        $this->offsetSet(Attribute::COMFORT_SERVICE_PLUS, (int) $comfort);
    }

    public function setDeliveryDate(DateTimeInterface $deliveryDate): void
    {
        $this->offsetSet(Attribute::DELIVERY_DATE, $deliveryDate->format('Y-m-d'));
    }

    public function setDateDelivery(DateTimeInterface $deliveryDate): void
    {
        $this->offsetSet(Attribute::DATE_DELIVERY, $deliveryDate->format('Y-m-d'));
    }

    public function setDeliveryTimeFrom(DateTimeInterface $deliveryTimeFrom): void
    {
        $this->offsetSet(Attribute::DELIVERY_TIME_FROM, $deliveryTimeFrom->format('H:i'));
    }

    public function setDeliveryTimeTo(DateTimeInterface $deliveryTimeTo): void
    {
        $this->offsetSet(Attribute::DELIVERY_TIME_TO, $deliveryTimeTo->format('H:i'));
    }

    public function setSwap(bool $swap): void
    {
        $this->offsetSet(Attribute::SWAP, (int) $swap);
    }

    public function setSwapOption(string $swapOption): void
    {
        $this->offsetSet(Attribute::SWAP_OPTION, $swapOption);
    }

    public function setOpenBeforePayment(bool $openBeforePayment = true): void
    {
        $this->offsetSet(Attribute::OPEN_BEFORE_PAYMENT, (int) $openBeforePayment);
    }

    public function setTestBeforePayment(bool $testBeforePayment = true): void
    {
        $this->offsetSet(Attribute::TEST_BEFORE_PAYMENT, (int) $testBeforePayment);
    }

    public function setNote(string $note): void
    {
        $this->offsetSet(Attribute::NOTE, $note);
    }

    public function setRecHouseNumber(string $recHouseNumber): void
    {
        $this->offsetSet(Attribute::REC_HOUSE_NUMBER, $recHouseNumber);
    }

    public function setRecBlock(string $recBlock): void
    {
        $this->offsetSet(Attribute::REC_BLOCK, $recBlock);
    }

    public function setRecEnterance(string $recEnteracne): void
    {
        $this->offsetSet(Attribute::REC_ENTERANCE, $recEnteracne);
    }

    public function setFloor(string $recFloor): void
    {
        $this->offsetSet(Attribute::REC_FLOOR, $recFloor);
    }

    public function setFlatNumber(string $recFlatNumber): void
    {
        $this->offsetSet(Attribute::REC_FLAT_NUMBER, $recFlatNumber);
    }

    public function setDeliveryCosts(float $deliveryCosts): void
    {
        $this->offsetSet(Attribute::DELIVERY_COSTS, $deliveryCosts);
    }

    public function setDeliveryCostsEUR(float $deliveryCosts): void
    {
        $this->offsetSet(Attribute::DELIVERY_COSTS_EUR, $deliveryCosts);
    }

    public function setPickupDate(DateTimeInterface $pickupDate): void
    {
        $this->offsetSet(Attribute::PICKUP_DATE, $pickupDate->format('Y-m-d'));
    }

    public function setPickupTimeFrom(DateTimeInterface $pickupTimeFrom): void
    {
        $this->offsetSet(Attribute::PICKUP_TIME_FROM, $pickupTimeFrom->format('H:i'));
    }

    public function setPickupTimeTo(DateTimeInterface $pickupTimeTo): void
    {
        $this->offsetSet(Attribute::PICKUP_TIME_TO, $pickupTimeTo->format('H:i'));
    }

    public function setDeclarationComments(string $value): void
    {
        $this->offsetSet(Attribute::DECLARATION_COMMENTS, $value);
    }

    public function setDeclarationChargesDiscount(float $value): void
    {
        $this->offsetSet(Attribute::DECLARATION_CHARGES_DISCOUNT, $value);
    }

    public function setDeclarationInsuranceCharges(float $value): void
    {
        $this->offsetSet(Attribute::DECLARATION_INSURANCE_CHARGES, $value);
    }

    public function setDeclarationOtherCharges(float $value): void
    {
        $this->offsetSet(Attribute::DECLARATION_OTHER_CHARGES, $value);
    }

    public function setDeclarationTransportCharges(float $value): void
    {
        $this->offsetSet(Attribute::DECLARATION_TRANSPORT_CHARGES, $value);
    }

    public function setIsAlcohol(bool $value): void
    {
        $this->offsetSet(Attribute::IS_ALCOHOL, (int) $value);
    }

    public function setShipperVat(string $code): void
    {
        $this->offsetSet(Attribute::SHIPPER_VAT, $code);
    }

    public function setShipperAccountNumber(string $number): void
    {
        $this->offsetSet(Attribute::SHIPPER_ACCOUNT_NUMBER, $number);
    }
}
