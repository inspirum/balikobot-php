<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Service;

use Inspirum\Balikobot\Model\AdrUnit\AdrUnitCollection;
use Inspirum\Balikobot\Model\Attribute\AttributeCollection;
use Inspirum\Balikobot\Model\Carrier\Carrier;
use Inspirum\Balikobot\Model\Carrier\CarrierCollection;
use Inspirum\Balikobot\Model\Country\CountryCollection;
use Inspirum\Balikobot\Model\ManipulationUnit\ManipulationUnitCollection;
use Inspirum\Balikobot\Model\Service\Service;
use Inspirum\Balikobot\Model\Service\ServiceCollection;
use Inspirum\Balikobot\Model\ZipCode\ZipCodeIterator;

interface SettingService
{
    /**
     * Get list of carriers
     *
     * @return \Inspirum\Balikobot\Model\Carrier\CarrierCollection&array<\Inspirum\Balikobot\Model\Carrier\Carrier>
     *
     * @throws \Inspirum\Balikobot\Exception\Exception
     */
    public function getCarriers(): CarrierCollection;

    /**
     * Get info about carrier
     *
     * @throws \Inspirum\Balikobot\Exception\Exception
     */
    public function getCarrier(string $carrier): Carrier;

    /**
     * Get services for carrier
     *
     * @return \Inspirum\Balikobot\Model\Service\ServiceCollection&array<\Inspirum\Balikobot\Model\Service\Service>
     *
     * @throws \Inspirum\Balikobot\Exception\Exception
     */
    public function getServices(string $carrier): ServiceCollection;

    /**
     * Get activated services for carrier
     *
     * @return \Inspirum\Balikobot\Model\Service\ServiceCollection&array<\Inspirum\Balikobot\Model\Service\Service>
     *
     * @throws \Inspirum\Balikobot\Exception\Exception
     */
    public function getActivatedServices(string $carrier): ServiceCollection;

    /**
     * Get B2A services for carrier
     *
     * @return \Inspirum\Balikobot\Model\Service\ServiceCollection&array<\Inspirum\Balikobot\Model\Service\Service>
     *
     * @throws \Inspirum\Balikobot\Exception\Exception
     */
    public function getB2AServices(string $carrier): ServiceCollection;

    /**
     * Get manipulation units for carrier
     *
     * @return \Inspirum\Balikobot\Model\ManipulationUnit\ManipulationUnitCollection&array<\Inspirum\Balikobot\Model\ManipulationUnit\ManipulationUnit>
     *
     * @throws \Inspirum\Balikobot\Exception\Exception
     */
    public function getManipulationUnits(string $carrier): ManipulationUnitCollection;

    /**
     * Get activated manipulation units for carrier
     *
     * @return \Inspirum\Balikobot\Model\ManipulationUnit\ManipulationUnitCollection&array<\Inspirum\Balikobot\Model\ManipulationUnit\ManipulationUnit>
     *
     * @throws \Inspirum\Balikobot\Exception\Exception
     */
    public function getActivatedManipulationUnits(string $carrier): ManipulationUnitCollection;

    /**
     * Get available countries by service type
     *
     * @return \Inspirum\Balikobot\Model\Service\ServiceCollection&array<\Inspirum\Balikobot\Model\Service\Service>
     *
     * @throws \Inspirum\Balikobot\Exception\Exception
     */
    public function getCountries(string $carrier): ServiceCollection;

    /**
     * Get countries by service type where cash-on-delivery payment type is available
     *
     * @return \Inspirum\Balikobot\Model\Service\ServiceCollection&array<\Inspirum\Balikobot\Model\Service\Service>
     *
     * @throws \Inspirum\Balikobot\Exception\Exception
     */
    public function getCodCountries(string $carrier): ServiceCollection;

    /**
     * Get information about countries
     *
     * @return \Inspirum\Balikobot\Model\Country\CountryCollection&array<\Inspirum\Balikobot\Model\Country\Country>
     *
     * @throws \Inspirum\Balikobot\Exception\Exception
     */
    public function getCountriesData(): CountryCollection;

    /**
     * Get post codes for carrier and its service type (and optionally by country)
     *
     * @return \Inspirum\Balikobot\Model\ZipCode\ZipCodeIterator&iterable<\Inspirum\Balikobot\Model\ZipCode\ZipCode>
     *
     * @throws \Inspirum\Balikobot\Exception\Exception
     */
    public function getZipCodes(string $carrier, string $service, ?string $country = null): ZipCodeIterator;

    /**
     * Get ADR units for carrier
     *
     * @return \Inspirum\Balikobot\Model\AdrUnit\AdrUnitCollection&array<\Inspirum\Balikobot\Model\AdrUnit\AdrUnit>
     *
     * @throws \Inspirum\Balikobot\Exception\Exception
     */
    public function getAdrUnits(string $carrier): AdrUnitCollection;

    /**
     * Get available package data options for carrier
     *
     * @return \Inspirum\Balikobot\Model\Attribute\AttributeCollection&array<\Inspirum\Balikobot\Model\Attribute\Attribute>
     *
     * @throws \Inspirum\Balikobot\Exception\Exception
     */
    public function getAddAttributes(string $carrier): AttributeCollection;

    /**
     * Get additional services (package data `services`) for carrier
     *
     * @return \Inspirum\Balikobot\Model\Service\ServiceCollection&array<\Inspirum\Balikobot\Model\Service\Service>
     *
     * @throws \Inspirum\Balikobot\Exception\Exception
     */
    public function getAddServiceOptions(string $carrier): ServiceCollection;

    /**
     * Get additional services (package data `services`) for carrier and service type
     *
     * @throws \Inspirum\Balikobot\Exception\Exception
     */
    public function getAddServiceOptionsForService(string $carrier, string $service): Service;
}
