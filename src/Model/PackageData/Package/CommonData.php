<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\PackageData\Package;

use Inspirum\Balikobot\Definitions\Option;
use function implode;

trait CommonData
{
    public function setEID(string $id): void
    {
        $this->offsetSet(Option::EID, $id);
    }

    public function getEID(): ?string
    {
        return $this[Option::EID] ?? null;
    }

    public function hasEID(): bool
    {
        return $this->offsetExists(Option::EID);
    }

    public function setOrderNumber(int $orderNumber): void
    {
        $this->offsetSet(Option::ORDER_NUMBER, $orderNumber);
    }

    public function setRealOrderId(string $realOrderId): void
    {
        $this->offsetSet(Option::REAL_ORDER_ID, $realOrderId);
    }

    public function setServiceType(string $serviceType): void
    {
        $this->offsetSet(Option::SERVICE_TYPE, $serviceType);
    }

    /**
     * @param array<string> $services
     */
    public function setServices(array $services): void
    {
        // TODO: add validation

        $this->offsetSet(Option::SERVICES, implode('+', $services));
    }

    public function setBranchId(string $branchId): void
    {
        $this->offsetSet(Option::BRANCH_ID, $branchId);
    }

    public function setReturnFullErrors(bool $fullErrors = true): void
    {
        $this->offsetSet(Option::RETURN_FULL_ERRORS, (int) $fullErrors);
    }

    public function setReturnTrack(bool $returnTrack = true): void
    {
        $this->offsetSet(Option::RETURN_TRACK, (int) $returnTrack);
    }

    public function setReturnFinalCarrierId(bool $returnCarrierId = true): void
    {
        $this->offsetSet(Option::RETURN_FINAL_CARRIER_ID, (int) $returnCarrierId);
    }
}
