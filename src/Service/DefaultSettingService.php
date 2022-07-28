<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Service;

use Inspirum\Balikobot\Client\Client;
use Inspirum\Balikobot\Definitions\RequestType;
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

final class DefaultSettingService implements SettingService
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

    public function getServices(string $carrier): ServiceCollection
    {
        $response = $this->client->call(VersionType::V2V1, $carrier, RequestType::SERVICES);

        return $this->serviceFactory->createCollection($carrier, $response);
    }

    public function getActivatedServices(string $carrier): ServiceCollection
    {
        $response = $this->client->call(VersionType::V2V1, $carrier, RequestType::ACTIVATED_SERVICES);

        return $this->serviceFactory->createCollection($carrier, $response);
    }

    public function getB2AServices(string $carrier): ServiceCollection
    {
        $response = $this->client->call(VersionType::V2V1, $carrier, RequestType::B2A_SERVICES);

        return $this->serviceFactory->createCollection($carrier, $response);
    }

    public function getManipulationUnits(string $carrier): ManipulationUnitCollection
    {
        $response = $this->client->call(VersionType::V2V1, $carrier, RequestType::MANIPULATION_UNITS);

        return $this->unitFactory->createCollection($carrier, $response);
    }

    public function getActivatedManipulationUnits(string $carrier): ManipulationUnitCollection
    {
        $response = $this->client->call(VersionType::V2V1, $carrier, RequestType::ACTIVATED_MANIPULATION_UNITS);

        return $this->unitFactory->createCollection($carrier, $response);
    }

    public function getCodCountries(string $carrier): ServiceCollection
    {
        $response = $this->client->call(VersionType::V2V1, $carrier, RequestType::CASH_ON_DELIVERY_COUNTRIES);

        return $this->serviceFactory->createCollection($carrier, $response);
    }

    public function getCountries(string $carrier): ServiceCollection
    {
        $response = $this->client->call(VersionType::V2V1, $carrier, RequestType::COUNTRIES);

        return $this->serviceFactory->createCollection($carrier, $response);
    }

    public function getCountriesData(): CountryCollection
    {
        $response = $this->client->call(VersionType::V2V1, null, RequestType::GET_COUNTRIES_DATA);

        return $this->countryFactory->createCollection($response);
    }

    /**
     * @return \Iterator<\Inspirum\Balikobot\Model\ZipCode\ZipCode>
     */
    public function getZipCodes(string $carrier, string $service, ?string $country = null): Iterator
    {
        $response = $this->client->call(VersionType::V2V1, $carrier, RequestType::ZIP_CODES, path: sprintf('%s/%s', $service, $country));

        return $this->postCodeFactory->createIterator($carrier, $service, $country, $response);
    }

    public function getAdrUnits(string $carrier): AdrUnitCollection
    {
        $response = $this->client->call(VersionType::V2V1, $carrier, RequestType::FULL_ADR_UNITS);

        return $this->adrUnitFactory->createCollection($carrier, $response);
    }

    public function getAddAttributes(string $carrier): AttributeCollection
    {
        $response = $this->client->call(VersionType::V2V1, $carrier, RequestType::ADD_ATTRIBUTES);

        return $this->attributeFactory->createCollection($carrier, $response);
    }

    public function getAddServiceOptions(string $carrier): ServiceCollection
    {
        $response = $this->client->call(VersionType::V2V1, $carrier, RequestType::ADD_SERVICE_OPTIONS);

        return $this->serviceFactory->createCollection($carrier, $response);
    }

    public function getAddServiceOptionsForService(string $carrier, string $service): Service
    {
        $response = $this->client->call(VersionType::V2V1, $carrier, RequestType::ADD_SERVICE_OPTIONS, path: $service);

        return $this->serviceFactory->create($carrier, $response);
    }
}
