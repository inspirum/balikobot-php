<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Branch;

interface BranchResolver
{
    /**
     * Determine if carrier service support full branch API
     */
    public function hasFullBranchesSupport(string $carrier, ?string $service): bool;

    /**
     * Determine if carrier has support to filter branches by country code.
     */
    public function hasBranchCountryFilterSupport(string $carrier, ?string $service): bool;
}
