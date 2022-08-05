<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\PackageData\Package;

use DateTimeInterface;
use Inspirum\Balikobot\Definitions\AttributeType;

trait DeliveryData
{
    public function setNoteDriver(string $noteDriver): void
    {
        $this->offsetSet(AttributeType::NOTE_DRIVER, $noteDriver);
    }

    public function setNoteCustomer(string $noteCustomer): void
    {
        $this->offsetSet(AttributeType::NOTE_CUSTOMER, $noteCustomer);
    }

    public function setComfortExclusiveService(bool $comfortExclusiveService = true): void
    {
        $this->offsetSet(AttributeType::COMFORT_EXCLUSIVE_SERVICE, (int) $comfortExclusiveService);
    }

    public function setPersDeliveryFloor(bool $persDeliveryFloor = true): void
    {
        $this->offsetSet(AttributeType::PERS_DELIVERY_FLOOR, (int) $persDeliveryFloor);
    }

    public function setPersDeliveryBuilding(bool $persDeliveryBuilding = true): void
    {
        $this->offsetSet(AttributeType::PERS_DELIVERY_BUILDING, (int) $persDeliveryBuilding);
    }

    public function setPersDeliveryDepartment(bool $persDeliveryDepartment = true): void
    {
        $this->offsetSet(AttributeType::PERS_DELIVERY_DEPARTMENT, (int) $persDeliveryDepartment);
    }

    public function setPIN(string $pin): void
    {
        $this->offsetSet(AttributeType::PIN, $pin);
    }

    public function setSatDelivery(bool $satDelivery = true): void
    {
        $this->offsetSet(AttributeType::SAT_DELIVERY, (int) $satDelivery);
    }

    public function setRequireFullAge(bool $requireFullAge = true): void
    {
        $this->offsetSet(AttributeType::REQUIRE_FULL_AGE, (int) $requireFullAge);
    }

    public function setFullAgeMinimum(string $fullAgeMinimum): void
    {
        $this->offsetSet(AttributeType::FULL_AGE_MINIMUM, $fullAgeMinimum);
    }

    public function setFullAgeData(string $fullAgeData): void
    {
        $this->offsetSet(AttributeType::FULL_AGE_DATA, $fullAgeData);
    }

    public function setPassword(string $password): void
    {
        $this->offsetSet(AttributeType::PASSWORD, $password);
    }

    public function setDelInsurance(bool $delInsurance = true): void
    {
        $this->offsetSet(AttributeType::DEL_INSURANCE, (int) $delInsurance);
    }

    public function setDelEvening(bool $delEvening = true): void
    {
        $this->offsetSet(AttributeType::DEL_EVENING, (int) $delEvening);
    }

    /**
     * @param bool $delExworks
     *
     * @return void
     */
    public function setDelExworks(bool $delExworks = true): void
    {
        $this->offsetSet(AttributeType::DEL_EXWORKS, (int) $delExworks);
    }

    public function setDelAccountNumber(string $delAccountNumber): void
    {
        $this->offsetSet(AttributeType::DEL_EXWORKS_ACCOUNT_NUMBER, $delAccountNumber);
    }

    public function setDelZip(string $delZip): void
    {
        $this->offsetSet(AttributeType::DEL_EXWORKS_ZIP, $delZip);
    }

    public function setDelCountryCode(string $countryCode): void
    {
        $this->offsetSet(AttributeType::DEL_EXWORKS_COUNTRY_CODE, $countryCode);
    }

    public function setComfortService(bool $comfort = true): void
    {
        $this->offsetSet(AttributeType::COMFORT_SERVICE, (int) $comfort);
    }

    public function setComfortServicePlus(bool $comfort = true): void
    {
        $this->offsetSet(AttributeType::COMFORT_SERVICE_PLUS, (int) $comfort);
    }

    public function setDeliveryDate(DateTimeInterface $deliveryDate): void
    {
        $this->offsetSet(AttributeType::DELIVERY_DATE, $deliveryDate->format('Y-m-d'));
    }

    public function setSwap(bool $swap): void
    {
        $this->offsetSet(AttributeType::SWAP, (int) $swap);
    }

    public function setSwapOption(string $swapOption): void
    {
        $this->offsetSet(AttributeType::SWAP_OPTION, $swapOption);
    }

    public function setOpenBeforePayment(bool $openBeforePayment = true): void
    {
        $this->offsetSet(AttributeType::OPEN_BEFORE_PAYMENT, (int) $openBeforePayment);
    }

    public function setTestBeforePayment(bool $testBeforePayment = true): void
    {
        $this->offsetSet(AttributeType::TEST_BEFORE_PAYMENT, (int) $testBeforePayment);
    }

    public function setNote(string $note): void
    {
        $this->offsetSet(AttributeType::NOTE, $note);
    }

    public function setRecHouseNumber(string $recHouseNumber): void
    {
        $this->offsetSet(AttributeType::REC_HOUSE_NUMBER, $recHouseNumber);
    }

    public function setRecBlock(string $recBlock): void
    {
        $this->offsetSet(AttributeType::REC_BLOCK, $recBlock);
    }

    public function setRecEnterance(string $recEnteracne): void
    {
        $this->offsetSet(AttributeType::REC_ENTERANCE, $recEnteracne);
    }

    public function setFloor(string $recFloor): void
    {
        $this->offsetSet(AttributeType::REC_FLOOR, $recFloor);
    }

    public function setFlatNumber(string $recFlatNumber): void
    {
        $this->offsetSet(AttributeType::REC_FLAT_NUMBER, $recFlatNumber);
    }

    public function setDeliveryCosts(float $deliveryCosts): void
    {
        $this->offsetSet(AttributeType::DELIVERY_COSTS, $deliveryCosts);
    }

    public function setDeliveryCostsEUR(float $deliveryCosts): void
    {
        $this->offsetSet(AttributeType::DELIVERY_COSTS_EUR, $deliveryCosts);
    }

    public function setPickupDate(DateTimeInterface $pickupDate): void
    {
        $this->offsetSet(AttributeType::PICKUP_DATE, $pickupDate->format('Y-m-d'));
    }

    public function setPickupTimeFrom(DateTimeInterface $pickupTimeFrom): void
    {
        $this->offsetSet(AttributeType::PICKUP_TIME_FROM, $pickupTimeFrom->format('H:i'));
    }

    public function setPickupTimeTo(DateTimeInterface $pickupTimeTo): void
    {
        $this->offsetSet(AttributeType::PICKUP_TIME_TO, $pickupTimeTo->format('H:i'));
    }

    public function setDeclarationComments(string $value): void
    {
        $this->offsetSet(AttributeType::DECLARATION_COMMENTS, $value);
    }

    public function setDeclarationChargesDiscount(float $value): void
    {
        $this->offsetSet(AttributeType::DECLARATION_CHARGES_DISCOUNT, $value);
    }

    public function setDeclarationInsuranceCharges(float $value): void
    {
        $this->offsetSet(AttributeType::DECLARATION_INSURANCE_CHARGES, $value);
    }

    public function setDeclarationOtherCharges(float $value): void
    {
        $this->offsetSet(AttributeType::DECLARATION_OTHER_CHARGES, $value);
    }

    public function setDeclarationTransportCharges(float $value): void
    {
        $this->offsetSet(AttributeType::DECLARATION_TRANSPORT_CHARGES, $value);
    }

    public function setIsAlcohol(bool $value): void
    {
        $this->offsetSet(AttributeType::IS_ALCOHOL, $value);
    }
}
