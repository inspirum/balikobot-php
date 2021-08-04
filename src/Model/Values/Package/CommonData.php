<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Values\Package;

use Inspirum\Balikobot\Definitions\Option;
use function implode;

trait CommonData
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
     * Get an item at a given offset
     *
     * @param string $key
     *
     * @return mixed
     */
    abstract public function offsetGet(string $key): mixed;

    /**
     * Determine if an item exists at an offset
     *
     * @param string $key
     *
     * @return bool
     */
    abstract public function offsetExists(string $key): bool;

    /**
     * Set EID
     *
     * @param string $id
     *
     * @return void
     */
    public function setEID(string $id): void
    {
        $this->offsetSet(Option::EID, $id);
    }

    /**
     * Get EID
     *
     * @return string|null
     */
    public function getEID(): ?string
    {
        return $this->offsetGet(Option::EID);
    }

    /**
     * Get EID
     *
     * @return bool
     */
    public function hasEID(): bool
    {
        return $this->offsetExists(Option::EID);
    }

    /**
     * @param int $orderNumber
     *
     * @return void
     */
    public function setOrderNumber(int $orderNumber): void
    {
        $this->offsetSet(Option::ORDER_NUMBER, $orderNumber);
    }

    /**
     * @param string $realOrderId
     *
     * @return void
     */
    public function setRealOrderId(string $realOrderId): void
    {
        $this->offsetSet(Option::REAL_ORDER_ID, $realOrderId);
    }

    /**
     * @param string $serviceType
     *
     * @return void
     */
    public function setServiceType(string $serviceType): void
    {
        $this->offsetSet(Option::SERVICE_TYPE, $serviceType);
    }

    /**
     * @param array<string> $services
     *
     * @return void
     */
    public function setServices(array $services): void
    {
        // TODO: add validation

        $this->offsetSet(Option::SERVICES, implode('+', $services));
    }

    /**
     * @param string $branchId
     *
     * @return void
     */
    public function setBranchId(string $branchId): void
    {
        $this->offsetSet(Option::BRANCH_ID, $branchId);
    }

    /**
     * @param bool $fullErrors
     *
     * @return void
     */
    public function setReturnFullErrors(bool $fullErrors = true): void
    {
        $this->offsetSet(Option::RETURN_FULL_ERRORS, (int) $fullErrors);
    }

    /**
     * @param bool $returnTrack
     *
     * @return void
     */
    public function setReturnTrack(bool $returnTrack = true): void
    {
        $this->offsetSet(Option::RETURN_TRACK, (int) $returnTrack);
    }

    /**
     * @param bool $returnCarrierId
     *
     * @return void
     */
    public function setReturnFinalCarrierId(bool $returnCarrierId = true): void
    {
        $this->offsetSet(Option::RETURN_FINAL_CARRIER_ID, (int) $returnCarrierId);
    }
}
