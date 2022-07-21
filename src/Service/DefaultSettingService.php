<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Service;

use Inspirum\Balikobot\Client\Client;
use Inspirum\Balikobot\Client\Request\Carrier;
use Inspirum\Balikobot\Definitions\Request;
use Inspirum\Balikobot\Definitions\VersionType;
use Inspirum\Balikobot\Model\AdrUnit\AdrUnitCollection;
use Inspirum\Balikobot\Model\AdrUnit\AdrUnitFactory;
use Inspirum\Balikobot\Model\Attribute\AttributeCollection;
use Inspirum\Balikobot\Model\Attribute\AttributeFactory;
use Inspirum\Balikobot\Model\Country\CountryCollection;
use Inspirum\Balikobot\Model\Country\CountryFactory;
use Inspirum\Balikobot\Model\ManipulationUnit\ManipulationUnitCollection;
use Inspirum\Balikobot\Model\ManipulationUnit\ManipulationUnitFactory;
use Inspirum\Balikobot\Model\Service\Service;
use Inspirum\Balikobot\Model\Service\ServiceCollection;
use Inspirum\Balikobot\Model\Service\ServiceFactory;
use Inspirum\Balikobot\Model\ZipCode\ZipCodeFactory;
use Iterator;
use function sprintf;

class DefaultSettingService implements SettingService
{
    public function __construct(
        private Client $client,
        private ServiceFactory $serviceFactory,
        private ManipulationUnitFactory $unitFactory,
        private CountryFactory $countryFactory,
        private ZipCodeFactory $postCodeFactory,
        private AdrUnitFactory $adrUnitFactory,
        private AttributeFactory $attributeFactory,
    ) {
    }

    public function getServices(Carrier $carrier): ServiceCollection
    {
        $response = $this->client->call(VersionType::V2V1, $carrier, Request::SERVICES);

        return $this->serviceFactory->createCollection($carrier, $response);
    }

    public function getActivatedServices(Carrier $carrier): ServiceCollection
    {
        $response = $this->client->call(VersionType::V2V1, $carrier, Request::ACTIVATED_SERVICES);

        return $this->serviceFactory->createCollection($carrier, $response);
    }

    public function getB2AServices(Carrier $carrier): ServiceCollection
    {
        $response = $this->client->call(VersionType::V2V1, $carrier, Request::B2A_SERVICES);

        return $this->serviceFactory->createCollection($carrier, $response);
    }

    public function getManipulationUnits(Carrier $carrier): ManipulationUnitCollection
    {
        $response = $this->client->call(VersionType::V2V1, $carrier, Request::MANIPULATION_UNITS);

        return $this->unitFactory->createCollection($carrier, $response);
    }

    public function getActivatedManipulationUnits(Carrier $carrier): ManipulationUnitCollection
    {
        $response = $this->client->call(VersionType::V2V1, $carrier, Request::ACTIVATED_MANIPULATION_UNITS);

        return $this->unitFactory->createCollection($carrier, $response);
    }

    public function getCodCountries(Carrier $carrier): ServiceCollection
    {
        $response = $this->client->call(VersionType::V2V1, $carrier, Request::CASH_ON_DELIVERY_COUNTRIES);

        return $this->serviceFactory->createCollection($carrier, $response);
    }

    public function getCountries(Carrier $carrier): ServiceCollection
    {
        $response = $this->client->call(VersionType::V2V1, $carrier, Request::COUNTRIES);

        return $this->serviceFactory->createCollection($carrier, $response);
    }

    public function getCountriesData(): CountryCollection
    {
        $response = $this->client->call(VersionType::V2V1, null, Request::GET_COUNTRIES_DATA);

        return $this->countryFactory->createCollection($response);
    }

    public function getZipCodes(Carrier $carrier, Service $service, ?string $country = null): Iterator
    {
        $response = $this->client->call(VersionType::V2V1, $carrier, Request::ZIP_CODES, path: sprintf('%s/%s', $service->getValue(), $country));

        return $this->postCodeFactory->createIterator($carrier, $service, $country, $response);
    }

    public function getAdrUnits(Carrier $carrier): AdrUnitCollection
    {
        $response = $this->client->call(VersionType::V2V1, $carrier, Request::FULL_ADR_UNITS);

        return $this->adrUnitFactory->createCollection($carrier, $response);
    }

    public function getAddAttributes(Carrier $carrier): AttributeCollection
    {
        $response = $this->client->call(VersionType::V2V1, $carrier, Request::ADD_ATTRIBUTES);

        return $this->attributeFactory->createCollection($carrier, $response);
    }

    public function getAddServiceOptions(Carrier $carrier): ServiceCollection
    {
        $response = $this->client->call(VersionType::V2V1, $carrier, Request::ADD_SERVICE_OPTIONS);

        return $this->serviceFactory->createCollection($carrier, $response);
    }

    public function getAddServiceOptionsForService(Carrier $carrier, Service $service): Service
    {
        $response = $this->client->call(VersionType::V2V1, $carrier, Request::ADD_SERVICE_OPTIONS, path: $service->getValue());

        return $this->serviceFactory->create($carrier, $response);
    }
}
