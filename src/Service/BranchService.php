<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Service;

use Traversable;

interface BranchService
{
    /**
     * Get all available branches
     *
     * @return \Traversable<\Inspirum\Balikobot\Model\Branch\Branch>
     *
     * @throws \Inspirum\Balikobot\Exception\Exception
     */
    public function getBranches(): Traversable;

    /**
     * Get all available branches for countries
     *
     * @param array<string> $countries
     *
     * @return \Traversable<\Inspirum\Balikobot\Model\Branch\Branch>
     *
     * @throws \Inspirum\Balikobot\Exception\Exception
     */
    public function getBranchesForCountries(array $countries): Traversable;

    /**
     * Get all available branches for carrier
     *
     * @return \Traversable<\Inspirum\Balikobot\Model\Branch\Branch>
     *
     * @throws \Inspirum\Balikobot\Exception\Exception
     */
    public function getBranchesForCarrier(string $carrier): Traversable;

    /**
     * Get all available branches for carrier and countries
     *
     * @param array<string> $countries
     *
     * @return \Traversable<\Inspirum\Balikobot\Model\Branch\Branch>
     *
     * @throws \Inspirum\Balikobot\Exception\Exception
     */
    public function getBranchesForCarrierAndCountries(string $carrier, array $countries): Traversable;

    /**
     * Get all available branches for carrier and service type
     *
     * @return \Traversable<\Inspirum\Balikobot\Model\Branch\Branch>
     *
     * @throws \Inspirum\Balikobot\Exception\Exception
     */
    public function getBranchesForCarrierService(string $carrier, ?string $service): Traversable;

    /**
     * Get all available branches for carrier, service type and countries
     *
     * @param array<string> $countries
     *
     * @return \Traversable<\Inspirum\Balikobot\Model\Branch\Branch>
     *
     * @throws \Inspirum\Balikobot\Exception\Exception
     */
    public function getBranchesForCarrierServiceAndCountries(string $carrier, ?string $service, array $countries): Traversable;

    /**
     * Get all available branches for carrier in specific location
     *
     * @return \Traversable<\Inspirum\Balikobot\Model\Branch\Branch>
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
    ): Traversable;
}
