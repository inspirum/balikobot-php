<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Branch;

interface BranchResolver
{
    /**
     * Determine if shipper service support full branch API
     */
    public function hasFullBranchesSupport(string $carrier, ?string $service): bool;

    /**
     * Determine if shipper has support to filter branches by country code.
     */
    public function hasBranchCountryFilterSupport(string $carrier, ?string $service): bool;
}
