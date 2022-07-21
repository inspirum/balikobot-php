<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Service;

use Inspirum\Balikobot\Client\Request\Carrier;
use Inspirum\Balikobot\Model\AdrUnit\AdrUnitCollection;
use Inspirum\Balikobot\Model\Attribute\AttributeCollection;
use Inspirum\Balikobot\Model\Country\CountryCollection;
use Inspirum\Balikobot\Model\ManipulationUnit\ManipulationUnitCollection;
use Inspirum\Balikobot\Model\Service\Service;
use Inspirum\Balikobot\Model\Service\ServiceCollection;
use Iterator;

interface SettingService
{
    /**
     * Get services for carrier
     *
     * @throws \Inspirum\Balikobot\Exception\Exception
     */
    public function getServices(Carrier $carrier): ServiceCollection;

    /**
     * Get activated services for carrier
     *
     * @throws \Inspirum\Balikobot\Exception\Exception
     */
    public function getActivatedServices(Carrier $carrier): ServiceCollection;

    /**
     * Get B2A services for carrier
     *
     * @throws \Inspirum\Balikobot\Exception\Exception
     */
    public function getB2AServices(Carrier $carrier): ServiceCollection;

    /**
     * Get manipulation units for carrier
     *
     * @throws \Inspirum\Balikobot\Exception\Exception
     */
    public function getManipulationUnits(Carrier $carrier): ManipulationUnitCollection;

    /**
     * Get activated manipulation units for carrier
     *
     * @throws \Inspirum\Balikobot\Exception\Exception
     */
    public function getActivatedManipulationUnits(Carrier $carrier): ManipulationUnitCollection;

    /**
     * Get available countries by service type
     *
     * @throws \Inspirum\Balikobot\Exception\Exception
     */
    public function getCountries(Carrier $carrier): ServiceCollection;

    /**
     * Get countries by service type where cash-on-delivery payment type is available
     *
     * @throws \Inspirum\Balikobot\Exception\Exception
     */
    public function getCodCountries(Carrier $carrier): ServiceCollection;

    /**
     * Get information about countries
     *
     * @throws \Inspirum\Balikobot\Exception\Exception
     */
    public function getCountriesData(): CountryCollection;

    /**
     * Get post codes for carrier and its service type (and optionally by country)
     *
     * @return \Iterator<\Inspirum\Balikobot\Model\ZipCode\ZipCode>
     *
     * @throws \Inspirum\Balikobot\Exception\Exception
     */
    public function getZipCodes(Carrier $carrier, Service $service, ?string $country = null): Iterator;

    /**
     * Get ADR units for carrier
     *
     * @throws \Inspirum\Balikobot\Exception\Exception
     */
    public function getAdrUnits(Carrier $carrier): AdrUnitCollection;

    /**
     * Get available package data options for carrier
     *
     * @throws \Inspirum\Balikobot\Exception\Exception
     */
    public function getAddAttributes(Carrier $carrier): AttributeCollection;

    /**
     * Get additional services (package data `services`) for carrier
     *
     * @throws \Inspirum\Balikobot\Exception\Exception
     */
    public function getAddServiceOptions(Carrier $carrier): ServiceCollection;

    /**
     * Get additional services (package data `services`) for carrier and service type
     *
     * @throws \Inspirum\Balikobot\Exception\Exception
     */
    public function getAddServiceOptionsForService(Carrier $carrier, Service $service): Service;
}
