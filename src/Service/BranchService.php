<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Service;

use Inspirum\Balikobot\Model\Branch\BranchIterator;

interface BranchService
{
    /**
     * Get all available branches
     *
     * @return \Inspirum\Balikobot\Model\Branch\BranchIterator&iterable<\Inspirum\Balikobot\Model\Branch\Branch>
     *
     * @throws \Inspirum\Balikobot\Exception\Exception
     */
    public function getBranches(): BranchIterator;

    /**
     * Get all available branches for countries
     *
     * @param array<string> $countries
     *
     * @return \Inspirum\Balikobot\Model\Branch\BranchIterator&iterable<\Inspirum\Balikobot\Model\Branch\Branch>
     *
     * @throws \Inspirum\Balikobot\Exception\Exception
     */
    public function getBranchesForCountries(array $countries): BranchIterator;

    /**
     * Get all available branches for carrier
     *
     * @throws \Inspirum\Balikobot\Exception\Exception
     */
    public function getBranchesForCarrier(string $carrier): BranchIterator;

    /**
     * Get all available branches for carrier and countries
     *
     * @param array<string> $countries
     *
     * @return \Inspirum\Balikobot\Model\Branch\BranchIterator&iterable<\Inspirum\Balikobot\Model\Branch\Branch>
     *
     * @throws \Inspirum\Balikobot\Exception\Exception
     */
    public function getBranchesForCarrierAndCountries(string $carrier, array $countries): BranchIterator;

    /**
     * Get all available branches for carrier and service type
     *
     * @return \Inspirum\Balikobot\Model\Branch\BranchIterator&iterable<\Inspirum\Balikobot\Model\Branch\Branch>
     *
     * @throws \Inspirum\Balikobot\Exception\Exception
     */
    public function getBranchesForCarrierService(string $carrier, string $service): BranchIterator;

    /**
     * Get all available branches for carrier, service type and countries
     *
     * @param array<string> $countries
     *
     * @return \Inspirum\Balikobot\Model\Branch\BranchIterator&iterable<\Inspirum\Balikobot\Model\Branch\Branch>
     *
     * @throws \Inspirum\Balikobot\Exception\Exception
     */
    public function getBranchesForCarrierServiceAndCountries(string $carrier, string $service, array $countries): BranchIterator;

    /**
     * Get all available branches for carrier in specific location
     *
     * @return \Inspirum\Balikobot\Model\Branch\BranchIterator&iterable<\Inspirum\Balikobot\Model\Branch\Branch>
     *
     * @throws \Inspirum\Balikobot\Exception\Exception
     */
    public function getBranchesForLocation(
        string $carrier,
        string $country,
        string $city,
        ?string $zipCode = null,
        ?string $street = null,
        ?int $maxResults = null,
        ?float $radius = null,
        ?string $type = null,
    ): BranchIterator;
}
