<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Service;

use Inspirum\Balikobot\Client\Request\Carrier;
use Inspirum\Balikobot\Client\Request\Service;

interface BranchService
{
    /**
     * Get all available branches
     *
     * @return iterable<\Inspirum\Balikobot\Model\Branch\Branch>
     *
     * @throws \Inspirum\Balikobot\Exception\Exception
     */
    public function getBranches(): iterable;

    /**
     * Get all available branches for countries
     *
     * @param array<string> $countries
     *
     * @return iterable<\Inspirum\Balikobot\Model\Branch\Branch>
     *
     * @throws \Inspirum\Balikobot\Exception\Exception
     */
    public function getBranchesForCountries(array $countries): iterable;

    /**
     * Get all available branches for carrier
     *
     * @return iterable<\Inspirum\Balikobot\Model\Branch\Branch>
     *
     * @throws \Inspirum\Balikobot\Exception\Exception
     */
    public function getBranchesForCarrier(Carrier $carrier): iterable;

    /**
     * Get all available branches for carrier and countries
     *
     * @param array<string> $countries
     *
     * @return iterable<\Inspirum\Balikobot\Model\Branch\Branch>
     *
     * @throws \Inspirum\Balikobot\Exception\Exception
     */
    public function getBranchesForCarrierAndCountries(Carrier $carrier, array $countries): iterable;

    /**
     * Get all available branches for carrier and service type
     *
     * @return iterable<\Inspirum\Balikobot\Model\Branch\Branch>
     *
     * @throws \Inspirum\Balikobot\Exception\Exception
     */
    public function getBranchesForCarrierService(Carrier $carrier, ?Service $service): iterable;

    /**
     * Get all available branches for carrier, service type and countries
     *
     * @param array<string> $countries
     *
     * @return iterable<\Inspirum\Balikobot\Model\Branch\Branch>
     *
     * @throws \Inspirum\Balikobot\Exception\Exception
     */
    public function getBranchesForCarrierServiceAndCountries(Carrier $carrier, ?Service $service, array $countries): iterable;

    /**
     * Get all available branches for carrier in specific location
     *
     * @return iterable<\Inspirum\Balikobot\Model\Branch\Branch>
     *
     * @throws \Inspirum\Balikobot\Exception\Exception
     */
    public function getBranchesForLocation(
        Carrier $carrier,
        string $country,
        string $city,
        ?string $zipCode = null,
        ?string $street = null,
        ?int $maxResults = null,
        ?float $radius = null,
        ?string $type = null,
    ): iterable;
}
