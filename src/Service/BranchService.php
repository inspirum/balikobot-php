<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Service;

use Inspirum\Balikobot\Definitions\Carrier;

interface BranchService
{
    /**
     * Get all available branches
     *
     * @return iterable<\Inspirum\Balikobot\Model\Branch>
     *
     * @throws \Inspirum\Balikobot\Exception\Exception
     */
    public function getBranches(): iterable;

    /**
     * Get all available branches for countries
     *
     * @param array<string> $countries
     *
     * @return iterable<\Inspirum\Balikobot\Model\Branch>
     *
     * @throws \Inspirum\Balikobot\Exception\Exception
     */
    public function getBranchesForCountries(array $countries): iterable;

    /**
     * Get all available branches for given shipper
     *
     * @return iterable<\Inspirum\Balikobot\Model\Branch>
     *
     * @throws \Inspirum\Balikobot\Exception\Exception
     */
    public function getBranchesForCarrier(string $carrier): iterable;

    /**
     * Get all available branches for given shipper for countries
     *
     * @param array<string> $countries
     *
     * @return iterable<\Inspirum\Balikobot\Model\Branch>
     *
     * @throws \Inspirum\Balikobot\Exception\Exception
     */
    public function getBranchesForCarrierAndCountries(string $carrier, array $countries): iterable;

    /**
     * Get all available branches for given shipper and service type for countries
     *
     * @param array<string> $countries
     *
     * @return iterable<\Inspirum\Balikobot\Model\Branch>
     *
     * @throws \Inspirum\Balikobot\Exception\Exception
     */
    public function getBranchesForCarrierServiceAndCountries(string $carrier, ?string $service, array $countries): iterable;

    /**
     * Get all available branches for given shipper and service type
     *
     * @return iterable<\Inspirum\Balikobot\Model\Branch>
     *
     * @throws \Inspirum\Balikobot\Exception\Exception
     */
    public function getBranchesForShipperServiceAndCountry(string $carrier, ?string $service, ?string $country = null): iterable;

    /**
     * Get all available branches for given shipper
     *
     * @return iterable<\Inspirum\Balikobot\Model\Branch>
     *
     * @throws \Inspirum\Balikobot\Exception\Exception
     */
    public function getBranchesForLocation(
        string $carrier,
        string $country,
        string $city,
        ?string $postcode = null,
        ?string $street = null,
        ?int $maxResults = null,
        ?float $radius = null,
        ?string $type = null,
    ): iterable;
}
