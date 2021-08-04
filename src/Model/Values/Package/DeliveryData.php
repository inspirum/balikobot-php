<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Values\Package;

use DateTime;
use Inspirum\Balikobot\Definitions\Option;

trait DeliveryData
{
    /**
     * Set the item at a given offset
     *
     * @param string $key
     * @param mixed  $value
     *
     * @return void
     */
    abstract public function offsetSet(string $key, mixed $value): void;

    /**
     * @param string $noteDriver
     *
     * @return void
     */
    public function setNoteDriver(string $noteDriver): void
    {
        $this->offsetSet(Option::NOTE_DRIVER, $noteDriver);
    }

    /**
     * @param string $noteCustomer
     *
     * @return void
     */
    public function setNoteCustomer(string $noteCustomer): void
    {
        $this->offsetSet(Option::NOTE_CUSTOMER, $noteCustomer);
    }

    /**
     * @param bool $comfortExclusiveService
     *
     * @return void
     */
    public function setComfortExclusiveService(bool $comfortExclusiveService = true): void
    {
        $this->offsetSet(Option::COMFORT_EXCLUSIVE_SERVICE, (int) $comfortExclusiveService);
    }

    /**
     * @param bool $persDeliveryFloor
     *
     * @return void
     */
    public function setPersDeliveryFloor(bool $persDeliveryFloor = true): void
    {
        $this->offsetSet(Option::PERS_DELIVERY_FLOOR, (int) $persDeliveryFloor);
    }

    /**
     * @param bool $persDeliveryBuilding
     *
     * @return void
     */
    public function setPersDeliveryBuilding(bool $persDeliveryBuilding = true): void
    {
        $this->offsetSet(Option::PERS_DELIVERY_BUILDING, (int) $persDeliveryBuilding);
    }

    /**
     * @param bool $persDeliveryDepartment
     *
     * @return void
     */
    public function setPersDeliveryDepartment(bool $persDeliveryDepartment = true): void
    {
        $this->offsetSet(Option::PERS_DELIVERY_DEPARTMENT, (int) $persDeliveryDepartment);
    }

    /**
     * @param string $pin
     *
     * @return void
     */
    public function setPIN(string $pin): void
    {
        $this->offsetSet(Option::PIN, $pin);
    }

    /**
     * @param bool $satDelivery
     *
     * @return void
     */
    public function setSatDelivery(bool $satDelivery = true): void
    {
        $this->offsetSet(Option::SAT_DELIVERY, (int) $satDelivery);
    }

    /**
     * @param bool $requireFullAge
     *
     * @return void
     */
    public function setRequireFullAge(bool $requireFullAge = true): void
    {
        $this->offsetSet(Option::REQUIRE_FULL_AGE, (int) $requireFullAge);
    }

    /**
     * @param string $fullAgeMinimum
     *
     * @return void
     */
    public function setFullAgeMinimum(string $fullAgeMinimum): void
    {
        $this->offsetSet(Option::FULL_AGE_MINIMUM, $fullAgeMinimum);
    }

    /**
     * @param string $fullAgeData
     *
     * @return void
     */
    public function setFullAgeData(string $fullAgeData): void
    {
        $this->offsetSet(Option::FULL_AGE_DATA, $fullAgeData);
    }

    /**
     * @param string $password
     *
     * @return void
     */
    public function setPassword(string $password): void
    {
        $this->offsetSet(Option::PASSWORD, $password);
    }

    /**
     * @param bool $delInsurance
     *
     * @return void
     */
    public function setDelInsurance(bool $delInsurance = true): void
    {
        $this->offsetSet(Option::DEL_INSURANCE, (int) $delInsurance);
    }

    /**
     * @param bool $delEvening
     *
     * @return void
     */
    public function setDelEvening(bool $delEvening = true): void
    {
        $this->offsetSet(Option::DEL_EVENING, (int) $delEvening);
    }

    /**
     * @param bool $delExworks
     *
     * @return void
     */
    public function setDelExworks(bool $delExworks = true): void
    {
        $this->offsetSet(Option::DEL_EXWORKS, (int) $delExworks);
    }

    /**
     * @param string $delAccountNumber
     *
     * @return void
     */
    public function setDelAccountNumber(string $delAccountNumber): void
    {
        $this->offsetSet(Option::DEL_EXWORKS_ACCOUNT_NUMBER, $delAccountNumber);
    }

    /**
     * @param string $delZip
     *
     * @return void
     */
    public function setDelZip(string $delZip): void
    {
        $this->offsetSet(Option::DEL_EXWORKS_ZIP, $delZip);
    }

    /**
     * @param bool $comfort
     *
     * @return void
     */
    public function setComfortService(bool $comfort = true): void
    {
        $this->offsetSet(Option::COMFORT_SERVICE, (int) $comfort);
    }

    /**
     * @param bool $comfort
     *
     * @return void
     */
    public function setComfortServicePlus(bool $comfort = true): void
    {
        $this->offsetSet(Option::COMFORT_SERVICE_PLUS, (int) $comfort);
    }

    /**
     * @param \DateTime $deliveryDate
     *
     * @return void
     */
    public function setDeliveryDate(DateTime $deliveryDate): void
    {
        $this->offsetSet(Option::DELIVERY_DATE, $deliveryDate->format('Y-m-d'));
    }

    /**
     * @param bool $swap
     *
     * @return void
     */
    public function setSwap(bool $swap): void
    {
        $this->offsetSet(Option::SWAP, (int) $swap);
    }

    /**
     * @param string $swapOption
     *
     * @return void
     */
    public function setSwapOption(string $swapOption): void
    {
        $this->offsetSet(Option::SWAP_OPTION, $swapOption);
    }

    /**
     * @param bool $openBeforePayment
     *
     * @return void
     */
    public function setOpenBeforePayment(bool $openBeforePayment = true): void
    {
        $this->offsetSet(Option::OPEN_BEFORE_PAYMENT, (int) $openBeforePayment);
    }

    /**
     * @param bool $testBeforePayment
     *
     * @return void
     */
    public function setTestBeforePayment(bool $testBeforePayment = true): void
    {
        $this->offsetSet(Option::TEST_BEFORE_PAYMENT, (int) $testBeforePayment);
    }

    /**
     * @param string $note
     *
     * @return void
     */
    public function setNote(string $note): void
    {
        $this->offsetSet(Option::NOTE, $note);
    }

    /**
     * @param string $recHouseNumber
     *
     * @return void
     */
    public function setRecHouseNumber(string $recHouseNumber): void
    {
        $this->offsetSet(Option::REC_HOUSE_NUMBER, $recHouseNumber);
    }

    /**
     * @param string $recBlock
     *
     * @return void
     */
    public function setRecBlock(string $recBlock): void
    {
        $this->offsetSet(Option::REC_BLOCK, $recBlock);
    }

    /**
     * @param string $recEnteracne
     *
     * @return void
     */
    public function setRecEnterance(string $recEnteracne): void
    {
        $this->offsetSet(Option::REC_ENTERANCE, $recEnteracne);
    }

    /**
     * @param string $recFloor
     *
     * @return void
     */
    public function setFloor(string $recFloor): void
    {
        $this->offsetSet(Option::REC_FLOOR, $recFloor);
    }

    /**
     * @param string $recFlatNumber
     *
     * @return void
     */
    public function setFlatNumber(string $recFlatNumber): void
    {
        $this->offsetSet(Option::REC_FLAT_NUMBER, $recFlatNumber);
    }

    /**
     * @param float $deliveryCosts
     *
     * @return void
     */
    public function setDeliveryCosts(float $deliveryCosts): void
    {
        $this->offsetSet(Option::DELIVERY_COSTS, $deliveryCosts);
    }

    /**
     * @param float $deliveryCosts
     *
     * @return void
     */
    public function setDeliveryCostsEUR(float $deliveryCosts): void
    {
        $this->offsetSet(Option::DELIVERY_COSTS_EUR, $deliveryCosts);
    }

    /**
     * @param \DateTime $pickupDate
     *
     * @return void
     */
    public function setPickupDate(DateTime $pickupDate): void
    {
        $this->offsetSet(Option::PICKUP_DATE, $pickupDate->format('Y-m-d'));
    }

    /**
     * @param \DateTime $pickupTimeFrom
     *
     * @return void
     */
    public function setPickupTimeFrom(DateTime $pickupTimeFrom): void
    {
        $this->offsetSet(Option::PICKUP_TIME_FROM, $pickupTimeFrom->format('H:i'));
    }

    /**
     * @param \DateTime $pickupTimeTo
     *
     * @return void
     */
    public function setPickupTimeTo(DateTime $pickupTimeTo): void
    {
        $this->offsetSet(Option::PICKUP_TIME_TO, $pickupTimeTo->format('H:i'));
    }

    /**
     * @param string $value
     *
     * @return void
     */
    public function setDeclarationComments(string $value): void
    {
        $this->offsetSet(Option::DECLARATION_COMMENTS, $value);
    }

    /**
     * @param float $value
     *
     * @return void
     */
    public function setDeclarationChargesDiscount(float $value): void
    {
        $this->offsetSet(Option::DECLARATION_CHARGES_DISCOUNT, $value);
    }

    /**
     * @param float $value
     *
     * @return void
     */
    public function setDeclarationInsuranceCharges(float $value): void
    {
        $this->offsetSet(Option::DECLARATION_INSURANCE_CHARGES, $value);
    }

    /**
     * @param float $value
     *
     * @return void
     */
    public function setDeclarationOtherCharges(float $value): void
    {
        $this->offsetSet(Option::DECLARATION_OTHER_CHARGES, $value);
    }

    /**
     * @param float $value
     *
     * @return void
     */
    public function setDeclarationTransportCharges(float $value): void
    {
        $this->offsetSet(Option::DECLARATION_TRANSPORT_CHARGES, $value);
    }

    /**
     * @param bool $value
     *
     * @return void
     */
    public function setIsAlcohol(bool $value): void
    {
        $this->offsetSet(Option::IS_ALCOHOL, $value);
    }
}
