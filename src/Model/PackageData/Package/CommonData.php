<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\PackageData\Package;

use Inspirum\Balikobot\Definitions\Attribute;
use function implode;

trait CommonData
{
    public function setEID(string $id): void
    {
        $this->offsetSet(Attribute::EID, $id);
    }

    public function getEID(): ?string
    {
        return $this[Attribute::EID] ?? null;
    }

    public function hasEID(): bool
    {
        return $this->offsetExists(Attribute::EID);
    }

    public function setOrderNumber(int $orderNumber): void
    {
        $this->offsetSet(Attribute::ORDER_NUMBER, $orderNumber);
    }

    public function setRealOrderId(string $realOrderId): void
    {
        $this->offsetSet(Attribute::REAL_ORDER_ID, $realOrderId);
    }

    public function setServiceType(string $serviceType): void
    {
        $this->offsetSet(Attribute::SERVICE_TYPE, $serviceType);
    }

    /**
     * @param array<string> $services
     */
    public function setServices(array $services): void
    {
        $this->offsetSet(Attribute::SERVICES, implode('+', $services));
    }

    public function setBranchId(string $branchId): void
    {
        $this->offsetSet(Attribute::BRANCH_ID, $branchId);
    }

    public function setBranchType(string $branchType): void
    {
        $this->offsetSet(Attribute::BRANCH_TYPE, $branchType);
    }

    public function setReturnFullErrors(bool $fullErrors = true): void
    {
        $this->offsetSet(Attribute::RETURN_FULL_ERRORS, (int) $fullErrors);
    }

    public function setReturnTrack(bool $returnTrack = true): void
    {
        $this->offsetSet(Attribute::RETURN_TRACK, (int) $returnTrack);
    }

    public function setReturnFinalCarrierId(bool $returnCarrierId = true): void
    {
        $this->offsetSet(Attribute::RETURN_FINAL_CARRIER_ID, (int) $returnCarrierId);
    }

    public function setReturnBarcode(bool $returnBarcode = true): void
    {
        $this->offsetSet(Attribute::RETURN_BARCODE, (int) $returnBarcode);
    }
}
