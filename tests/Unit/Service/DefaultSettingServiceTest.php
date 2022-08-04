<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Service;

use Inspirum\Balikobot\Client\Client;
use Inspirum\Balikobot\Definitions\Carrier;
use Inspirum\Balikobot\Definitions\Country;
use Inspirum\Balikobot\Definitions\RequestType;
use Inspirum\Balikobot\Definitions\ServiceType;
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
use Inspirum\Balikobot\Model\ZipCode\ZipCodeIterator;
use Inspirum\Balikobot\Service\DefaultSettingService;
use function sprintf;

final class DefaultSettingServiceTest extends BaseServiceTestCase
{
    public function testGetServices(): void
    {
        $carrier        = Carrier::CP;
        $response       = $this->mockClientResponse();
        $expectedResult = $this->createMock(ServiceCollection::class);

        $settingService = $this->newDefaultSettingService(
            client: $this->mockClient([VersionType::V2V1, $carrier, RequestType::SERVICES], $response),
            serviceFactory: $this->mockServiceFactory($carrier, $response, $expectedResult),
        );

        $actualResult = $settingService->getServices($carrier);

        self::assertSame($expectedResult, $actualResult);
    }

    public function testGetActivatedServices(): void
    {
        $carrier        = Carrier::CP;
        $response       = $this->mockClientResponse();
        $expectedResult = $this->createMock(ServiceCollection::class);

        $settingService = $this->newDefaultSettingService(
            client: $this->mockClient([VersionType::V2V1, $carrier, RequestType::ACTIVATED_SERVICES], $response),
            serviceFactory: $this->mockServiceFactory($carrier, $response, $expectedResult),
        );

        $actualResult = $settingService->getActivatedServices($carrier);

        self::assertSame($expectedResult, $actualResult);
    }

    public function testGetB2AServices(): void
    {
        $carrier        = Carrier::CP;
        $response       = $this->mockClientResponse();
        $expectedResult = $this->createMock(ServiceCollection::class);

        $settingService = $this->newDefaultSettingService(
            client: $this->mockClient([VersionType::V2V1, $carrier, RequestType::B2A_SERVICES], $response),
            serviceFactory: $this->mockServiceFactory($carrier, $response, $expectedResult),
        );

        $actualResult = $settingService->getB2AServices($carrier);

        self::assertSame($expectedResult, $actualResult);
    }

    public function testGetManipulationUnits(): void
    {
        $carrier        = Carrier::CP;
        $response       = $this->mockClientResponse();
        $expectedResult = $this->createMock(ManipulationUnitCollection::class);

        $settingService = $this->newDefaultSettingService(
            client: $this->mockClient([VersionType::V2V1, $carrier, RequestType::MANIPULATION_UNITS], $response),
            unitFactory: $this->mockUnitFactory($carrier, $response, $expectedResult),
        );

        $actualResult = $settingService->getManipulationUnits($carrier);

        self::assertSame($expectedResult, $actualResult);
    }

    public function testGetActivatedManipulationUnits(): void
    {
        $carrier        = Carrier::TOPTRANS;
        $response       = $this->mockClientResponse();
        $expectedResult = $this->createMock(ManipulationUnitCollection::class);

        $settingService = $this->newDefaultSettingService(
            client: $this->mockClient([VersionType::V2V1, $carrier, RequestType::ACTIVATED_MANIPULATION_UNITS], $response),
            unitFactory: $this->mockUnitFactory($carrier, $response, $expectedResult),
        );

        $actualResult = $settingService->getActivatedManipulationUnits($carrier);

        self::assertSame($expectedResult, $actualResult);
    }

    public function testGetCodCountries(): void
    {
        $carrier        = Carrier::CP;
        $response       = $this->mockClientResponse();
        $expectedResult = $this->createMock(ServiceCollection::class);

        $settingService = $this->newDefaultSettingService(
            client: $this->mockClient([VersionType::V2V1, $carrier, RequestType::CASH_ON_DELIVERY_COUNTRIES], $response),
            serviceFactory: $this->mockServiceFactory($carrier, $response, $expectedResult),
        );

        $actualResult = $settingService->getCodCountries($carrier);

        self::assertSame($expectedResult, $actualResult);
    }

    public function testGetCountries(): void
    {
        $carrier        = Carrier::CP;
        $response       = $this->mockClientResponse();
        $expectedResult = $this->createMock(ServiceCollection::class);

        $settingService = $this->newDefaultSettingService(
            client: $this->mockClient([VersionType::V2V1, $carrier, RequestType::COUNTRIES], $response),
            serviceFactory: $this->mockServiceFactory($carrier, $response, $expectedResult),
        );

        $actualResult = $settingService->getCountries($carrier);

        self::assertSame($expectedResult, $actualResult);
    }

    public function testGetCountriesData(): void
    {
        $response       = $this->mockClientResponse();
        $expectedResult = $this->createMock(CountryCollection::class);

        $settingService = $this->newDefaultSettingService(
            client: $this->mockClient([VersionType::V2V1, null, RequestType::GET_COUNTRIES_DATA], $response),
            countryFactory: $this->mockCountryFactory($response, $expectedResult),
        );

        $actualResult = $settingService->getCountriesData();

        self::assertSame($expectedResult, $actualResult);
    }

    public function testGetZipCodes(): void
    {
        $carrier        = Carrier::CP;
        $serviceType    = ServiceType::CP_DR;
        $country        = Country::CZECH_REPUBLIC;
        $response       = $this->mockClientResponse();
        $expectedResult = $this->createMock(ZipCodeIterator::class);

        $settingService = $this->newDefaultSettingService(
            client: $this->mockClient([VersionType::V2V1, $carrier, RequestType::ZIP_CODES, [], sprintf('%s/%s', $serviceType, $country)], $response),
            zipCodeFactory: $this->mockZipCodeFactory($carrier, $serviceType, $country, $response, $expectedResult),
        );

        $actualResult = $settingService->getZipCodes($carrier, $serviceType, $country);

        self::assertSame($expectedResult, $actualResult);
    }

    public function testGetAdrUnits(): void
    {
        $carrier        = Carrier::TOPTRANS;
        $response       = $this->mockClientResponse();
        $expectedResult = $this->createMock(AdrUnitCollection::class);

        $settingService = $this->newDefaultSettingService(
            client: $this->mockClient([VersionType::V2V1, $carrier, RequestType::FULL_ADR_UNITS], $response),
            adrUnitFactory: $this->mockAdrUnitFactory($carrier, $response, $expectedResult),
        );

        $actualResult = $settingService->getAdrUnits($carrier);

        self::assertSame($expectedResult, $actualResult);
    }

    public function testGetAddAttributes(): void
    {
        $carrier        = Carrier::CP;
        $response       = $this->mockClientResponse();
        $expectedResult = $this->createMock(AttributeCollection::class);

        $settingService = $this->newDefaultSettingService(
            client: $this->mockClient([VersionType::V2V1, $carrier, RequestType::ADD_ATTRIBUTES], $response),
            attributeFactory: $this->mockAttributeFactory($carrier, $response, $expectedResult),
        );

        $actualResult = $settingService->getAddAttributes($carrier);

        self::assertSame($expectedResult, $actualResult);
    }

    public function testGetAddServiceOptions(): void
    {
        $carrier        = Carrier::CP;
        $response       = $this->mockClientResponse();
        $expectedResult = $this->createMock(ServiceCollection::class);

        $settingService = $this->newDefaultSettingService(
            client: $this->mockClient([VersionType::V2V1, $carrier, RequestType::ADD_SERVICE_OPTIONS], $response),
            serviceFactory: $this->mockServiceFactory($carrier, $response, $expectedResult),
        );

        $actualResult = $settingService->getAddServiceOptions($carrier);

        self::assertSame($expectedResult, $actualResult);
    }

    public function testGetAddServiceOptionsForService(): void
    {
        $carrier        = Carrier::CP;
        $serviceType    = ServiceType::CP_DR;
        $response       = $this->mockClientResponse();
        $expectedResult = $this->createMock(Service::class);

        $settingService = $this->newDefaultSettingService(
            client: $this->mockClient([VersionType::V2V1, $carrier, RequestType::ADD_SERVICE_OPTIONS, [], $serviceType], $response),
            serviceFactory: $this->mockServiceFactory($carrier, $response, $expectedResult),
        );

        $actualResult = $settingService->getAddServiceOptionsForService($carrier, $serviceType);

        self::assertSame($expectedResult, $actualResult);
    }

    /**
     * @param array<string,mixed> $data
     */
    private function mockServiceFactory(string $carrier, array $data, ServiceCollection|Service $response): ServiceFactory
    {
        $serviceFactory = $this->createMock(ServiceFactory::class);
        $serviceFactory->expects(self::once())->method($response instanceof Service ? 'create' : 'createCollection')->with($carrier, $data)
                       ->willReturn($response);

        return $serviceFactory;
    }

    /**
     * @param array<string,mixed> $data
     */
    private function mockUnitFactory(string $carrier, array $data, ManipulationUnitCollection $response): ManipulationUnitFactory
    {
        $manipulationUnitFactory = $this->createMock(ManipulationUnitFactory::class);
        $manipulationUnitFactory->expects(self::once())->method('createCollection')->with($carrier, $data)->willReturn($response);

        return $manipulationUnitFactory;
    }

    /**
     * @param array<string,mixed> $data
     */
    private function mockCountryFactory(array $data, CountryCollection $response): CountryFactory
    {
        $countryFactory = $this->createMock(CountryFactory::class);
        $countryFactory->expects(self::once())->method('createCollection')->with($data)->willReturn($response);

        return $countryFactory;
    }

    /**
     * @param array<string,mixed> $data
     */
    private function mockZipCodeFactory(
        string $carrier,
        string $service,
        ?string $country,
        array $data,
        ZipCodeIterator $response
    ): ZipCodeFactory {
        $zipCodeFactory = $this->createMock(ZipCodeFactory::class);
        $zipCodeFactory->expects(self::once())->method('createIterator')->with($carrier, $service, $country, $data)->willReturn($response);

        return $zipCodeFactory;
    }

    /**
     * @param array<string,mixed> $data
     */
    private function mockAdrUnitFactory(string $carrier, array $data, AdrUnitCollection $response): AdrUnitFactory
    {
        $adrUnitFactory = $this->createMock(AdrUnitFactory::class);
        $adrUnitFactory->expects(self::once())->method('createCollection')->with($carrier, $data)->willReturn($response);

        return $adrUnitFactory;
    }

    /**
     * @param array<string,mixed> $data
     */
    private function mockAttributeFactory(string $carrier, array $data, AttributeCollection $response): AttributeFactory
    {
        $attributeFactory = $this->createMock(AttributeFactory::class);
        $attributeFactory->expects(self::once())->method('createCollection')->with($carrier, $data)->willReturn($response);

        return $attributeFactory;
    }

    private function newDefaultSettingService(
        Client $client,
        ?ServiceFactory $serviceFactory = null,
        ?ManipulationUnitFactory $unitFactory = null,
        ?CountryFactory $countryFactory = null,
        ?ZipCodeFactory $zipCodeFactory = null,
        ?AdrUnitFactory $adrUnitFactory = null,
        ?AttributeFactory $attributeFactory = null,
    ): DefaultSettingService {
        return new DefaultSettingService(
            $client,
            $serviceFactory ?? $this->createMock(ServiceFactory::class),
            $unitFactory ?? $this->createMock(ManipulationUnitFactory::class),
            $countryFactory ?? $this->createMock(CountryFactory::class),
            $zipCodeFactory ?? $this->createMock(ZipCodeFactory::class),
            $adrUnitFactory ?? $this->createMock(AdrUnitFactory::class),
            $attributeFactory ?? $this->createMock(AttributeFactory::class),
        );
    }
}
