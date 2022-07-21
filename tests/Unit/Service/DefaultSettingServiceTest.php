<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Service;

use ArrayIterator;
use Inspirum\Balikobot\Client\Client;
use Inspirum\Balikobot\Client\Request\Carrier;
use Inspirum\Balikobot\Client\Request\Service;
use Inspirum\Balikobot\Definitions\CarrierType;
use Inspirum\Balikobot\Definitions\Country;
use Inspirum\Balikobot\Definitions\Request;
use Inspirum\Balikobot\Definitions\ServiceType;
use Inspirum\Balikobot\Definitions\VersionType;
use Inspirum\Balikobot\Model\AdrUnit\AdrUnit;
use Inspirum\Balikobot\Model\AdrUnit\AdrUnitCollection;
use Inspirum\Balikobot\Model\AdrUnit\AdrUnitFactory;
use Inspirum\Balikobot\Model\Attribute\Attribute;
use Inspirum\Balikobot\Model\Attribute\AttributeCollection;
use Inspirum\Balikobot\Model\Attribute\AttributeFactory;
use Inspirum\Balikobot\Model\Country\CodCountry;
use Inspirum\Balikobot\Model\Country\Country as CountryModel;
use Inspirum\Balikobot\Model\Country\CountryCollection;
use Inspirum\Balikobot\Model\Country\CountryFactory;
use Inspirum\Balikobot\Model\PostCode\PostCode;
use Inspirum\Balikobot\Model\PostCode\PostCodeFactory;
use Inspirum\Balikobot\Model\Service\Service as ServiceModel;
use Inspirum\Balikobot\Model\Service\ServiceCollection;
use Inspirum\Balikobot\Model\Service\ServiceFactory;
use Inspirum\Balikobot\Model\Service\ServiceOption;
use Inspirum\Balikobot\Model\Service\ServiceOptionCollection;
use Inspirum\Balikobot\Model\Unit\Unit;
use Inspirum\Balikobot\Model\Unit\UnitCollection;
use Inspirum\Balikobot\Model\Unit\UnitFactory;
use Inspirum\Balikobot\Service\DefaultSettingService;
use Inspirum\Balikobot\Tests\BaseTestCase;
use function array_replace;
use function sprintf;

final class DefaultSettingServiceTest extends BaseTestCase
{
    public function testGetServices(): void
    {
        $carrier        = CarrierType::CP;
        $response       = [
            'service_types' => [
                [
                    'service_type' => 'NP',
                    'name'         => 'NP - Balík Na poštu',
                ],
                [
                    'service_type' => 'RR',
                    'name'         => 'RR - Doporučená zásilka Ekonomická',
                ],
            ],
        ];
        $expectedResult = new ServiceCollection($carrier, [
            new ServiceModel('NP', 'NP - Balík Na poštu'),
            new ServiceModel('RR', 'RR - Doporučená zásilka Ekonomická'),
        ]);

        $service = $this->newDefaultSettingService(
            client: $this->mockClient([VersionType::V2V1, $carrier, Request::SERVICES], $response),
            serviceFactory: $this->mockServiceFactory($carrier, $response, $expectedResult),
        );

        $actualResult = $service->getServices($carrier);

        self::assertSame($expectedResult, $actualResult);
    }

    public function testGetActivatedServices(): void
    {
        $carrier        = CarrierType::CP;
        $response       = [
            'service_types' => [
                [
                    'service_type' => 'NP',
                    'name'         => 'NP - Balík Na poštu',
                ],
                [
                    'service_type' => 'RR',
                    'name'         => 'RR - Doporučená zásilka Ekonomická',
                ],
            ],
        ];
        $expectedResult = new ServiceCollection($carrier, [
            new ServiceModel('NP', 'NP - Balík Na poštu'),
            new ServiceModel('RR', 'RR - Doporučená zásilka Ekonomická'),
        ]);

        $service = $this->newDefaultSettingService(
            client: $this->mockClient([VersionType::V2V1, $carrier, Request::ACTIVATED_SERVICES], $response),
            serviceFactory: $this->mockServiceFactory($carrier, $response, $expectedResult),
        );

        $actualResult = $service->getActivatedServices($carrier);

        self::assertSame($expectedResult, $actualResult);
    }

    public function testGetB2AServices(): void
    {
        $carrier        = CarrierType::CP;
        $response       = [
            'service_types' => [
                [
                    'service_type' => 'NP',
                    'name'         => 'NP - Balík Na poštu',
                ],
                [
                    'service_type' => 'RR',
                    'name'         => 'RR - Doporučená zásilka Ekonomická',
                ],
            ],
        ];
        $expectedResult = new ServiceCollection($carrier, [
            new ServiceModel('NP', 'NP - Balík Na poštu'),
            new ServiceModel('RR', 'RR - Doporučená zásilka Ekonomická'),
        ]);

        $service = $this->newDefaultSettingService(
            client: $this->mockClient([VersionType::V2V1, $carrier, Request::B2A_SERVICES], $response),
            serviceFactory: $this->mockServiceFactory($carrier, $response, $expectedResult),
        );

        $actualResult = $service->getB2AServices($carrier);

        self::assertSame($expectedResult, $actualResult);
    }

    public function testGetManipulationUnits(): void
    {
        $carrier  = CarrierType::CP;
        $response = [
            'units' => [
                [
                    'code' => 'KARTON',
                    'name' => 'KARTON',
                ],
                [
                    'code' => 'KUS',
                    'name' => 'KUS',
                ],
            ],
        ];

        $expectedResult = new UnitCollection($carrier, [
            new Unit('KARTON', 'KARTON'),
            new Unit('KUS', 'KUS'),
        ]);

        $service = $this->newDefaultSettingService(
            client: $this->mockClient([VersionType::V2V1, $carrier, Request::MANIPULATION_UNITS], $response),
            unitFactory: $this->mockUnitFactory($carrier, $response, $expectedResult),
        );

        $actualResult = $service->getManipulationUnits($carrier);

        self::assertSame($expectedResult, $actualResult);
    }

    public function testGetActivatedManipulationUnits(): void
    {
        $carrier  = CarrierType::TOPTRANS;
        $response = [
            'units' => [
                [
                    'code' => 'KARTON',
                    'name' => 'KARTON',
                ],
                [
                    'code' => 'PALETA',
                    'name' => 'PALETA',
                ],
            ],
        ];

        $expectedResult = new UnitCollection($carrier, [
            new Unit('KARTON', 'KARTON'),
            new Unit('PALETA', 'PALETA'),
        ]);

        $service = $this->newDefaultSettingService(
            client: $this->mockClient([VersionType::V2V1, $carrier, Request::ACTIVATED_MANIPULATION_UNITS], $response),
            unitFactory: $this->mockUnitFactory($carrier, $response, $expectedResult),
        );

        $actualResult = $service->getActivatedManipulationUnits($carrier);

        self::assertSame($expectedResult, $actualResult);
    }

    public function testGetCodCountries(): void
    {
        $carrier        = CarrierType::CP;
        $response       = [
            'service_types' => [
                [
                    'service_type'  => 'DR',
                    'cod_countries' => [
                        'CZ' => [
                            'max_price' => 100000,
                            'currency'  => 'CZK',
                        ],
                    ],
                ],
            ],
        ];
        $expectedResult = new ServiceCollection($carrier, [
            new ServiceModel('DR', null, codCountries: [
                new CodCountry(
                    'CZ',
                    'CZK',
                    100000,
                ),
            ]),
        ]);

        $service = $this->newDefaultSettingService(
            client: $this->mockClient([VersionType::V2V1, $carrier, Request::CASH_ON_DELIVERY_COUNTRIES], $response),
            serviceFactory: $this->mockServiceFactory($carrier, $response, $expectedResult),
        );

        $actualResult = $service->getCodCountries($carrier);

        self::assertSame($expectedResult, $actualResult);
    }

    public function testGetCountries(): void
    {
        $carrier        = CarrierType::CP;
        $response       = [
            'service_types' => [
                [
                    'service_type' => 'RZP',
                    'countries'    => [
                        'SK',
                        'CY',
                        'MT',
                    ],
                ],
            ],
        ];
        $expectedResult = new ServiceCollection($carrier, [
            new ServiceModel('RZP', null, countries: [
                'SK',
                'CY',
                'MT',
            ]),
        ]);

        $service = $this->newDefaultSettingService(
            client: $this->mockClient([VersionType::V2V1, $carrier, Request::COUNTRIES], $response),
            serviceFactory: $this->mockServiceFactory($carrier, $response, $expectedResult),
        );

        $actualResult = $service->getCountries($carrier);

        self::assertSame($expectedResult, $actualResult);
    }

    public function testGetCountriesData(): void
    {
        $response       = [
            'countries' => [
                [
                    'name_en'      => 'Andorra',
                    'name_cz'      => 'Andorra',
                    'iso_code'     => 'AD',
                    'phone_prefix' => '+376',
                    'currency'     => 'EUR',
                    'continent'    => 'Europe',
                ],
            ],
        ];
        $expectedResult = new CountryCollection([
            new CountryModel(
                [
                    'cz' => 'Andorra',
                    'en' => 'Andorra',
                ],
                'AD',
                'EUR',
                [
                    '+376',
                ],
                'Europe',
            ),
        ]);

        $service = $this->newDefaultSettingService(
            client: $this->mockClient([VersionType::V2V1, null, Request::GET_COUNTRIES_DATA], $response),
            countryFactory: $this->mockCountryFactory($response, $expectedResult),
        );

        $actualResult = $service->getCountriesData();

        self::assertSame($expectedResult, $actualResult);
    }

    public function testGetPostCodes(): void
    {
        $carrier        = CarrierType::CP;
        $serviceType    = ServiceModel::from(ServiceType::CP_DR);
        $country        = Country::CZECH_REPUBLIC;
        $response       = [
            'units' => [
                [
                    'zip'     => '79862',
                    '1B'      => false,
                    'country' => 'CZ',
                ],
                [
                    'zip'     => '79907',
                    '1B'      => false,
                    'country' => 'CZ',
                ],
            ],
        ];
        $expectedResult = new ArrayIterator([
            new PostCode(
                $carrier,
                $serviceType,
                '79862',
                null,
                null,
                'CZ',
                false,
            ),
            new PostCode(
                $carrier,
                $serviceType,
                '79907',
                null,
                null,
                'CZ',
                false,
            ),
        ]);

        $service = $this->newDefaultSettingService(
            client: $this->mockClient([VersionType::V2V1, $carrier, Request::ZIP_CODES, [], sprintf('%s/%s', $serviceType->getValue(), $country)], $response),
            postCodeFactory: $this->mockPostCodeFactory($carrier, $serviceType, $country, $response, $expectedResult),
        );

        $actualResult = $service->getPostCodes($carrier, $serviceType, $country);

        self::assertSame($expectedResult, $actualResult);
    }

    public function testGetAdrUnits(): void
    {
        $carrier        = CarrierType::TOPTRANS;
        $response       = [
            'units' => [
                [
                    'id'                 => '2892',
                    'code'               => '3509',
                    'name'               => 'OBALY PRAZDNE, NEVYCISTENE',
                    'class'              => '9',
                    'packaging'          => null,
                    'tunnel_code'        => 'E',
                    'transport_category' => '4',
                ],
            ],
        ];
        $expectedResult = new AdrUnitCollection($carrier, [
            new AdrUnit(
                $carrier,
                '2892',
                '3509',
                'OBALY PRAZDNE, NEVYCISTENE',
                '9',
                null,
                'E',
                '4',
            ),
        ]);

        $service = $this->newDefaultSettingService(
            client: $this->mockClient([VersionType::V2V1, $carrier, Request::FULL_ADR_UNITS], $response),
            adrUnitFactory: $this->mockAdrUnitFactory($carrier, $response, $expectedResult),
        );

        $actualResult = $service->getAdrUnits($carrier);

        self::assertSame($expectedResult, $actualResult);
    }

    public function testGetAddAttributes(): void
    {
        $carrier        = CarrierType::CP;
        $response       = [
            'attributes' => [
                [
                    'data_type'  => 'string',
                    'name'       => 'eid',
                    'max_length' => '40',
                ],
                [
                    'data_type'  => 'plus_separated_values',
                    'name'       => 'services',
                    'max_length' => null,
                ],
            ],
        ];
        $expectedResult = new AttributeCollection($carrier, [
            new Attribute(
                'eid',
                'string',
                '40',
            ),
            new Attribute(
                'services',
                'plus_separated_values',
                null,
            ),
        ]);

        $service = $this->newDefaultSettingService(
            client: $this->mockClient([VersionType::V2V1, $carrier, Request::ADD_ATTRIBUTES], $response),
            attributeFactory: $this->mockAttributeFactory($carrier, $response, $expectedResult),
        );

        $actualResult = $service->getAddAttributes($carrier);

        self::assertSame($expectedResult, $actualResult);
    }

    public function testGetAddServiceOptions(): void
    {
        $carrier        = CarrierType::CP;
        $response       = [
            'service_types' => [
                [
                    'service_type'      => 'CE',
                    'service_type_name' => 'CE - Obchodní balík do zahraničí',
                    'services'          => [
                        [
                            'name' => 'Neskladně',
                            'code' => '10',
                        ],
                        [
                            'name' => 'Zboží s VDD (pouze pro zásilky do ciziny s celní zónou)',
                            'code' => '44',
                        ],
                    ],
                ],
            ],
        ];
        $expectedResult = new ServiceCollection($carrier, [
            new ServiceModel('DR', null, options: new ServiceOptionCollection([
                new ServiceOption(
                    '10',
                    'Neskladně',
                ),
                new ServiceOption(
                    '44',
                    'Zboží s VDD (pouze pro zásilky do ciziny s celní zónou)',
                ),
            ])),
        ]);

        $service = $this->newDefaultSettingService(
            client: $this->mockClient([VersionType::V2V1, $carrier, Request::ADD_SERVICE_OPTIONS], $response),
            serviceFactory: $this->mockServiceFactory($carrier, $response, $expectedResult),
        );

        $actualResult = $service->getAddServiceOptions($carrier);

        self::assertSame($expectedResult, $actualResult);
    }

    public function testGetAddServiceOptionsForService(): void
    {
        $carrier        = CarrierType::CP;
        $serviceType    = ServiceModel::from(ServiceType::CP_DR);
        $response       = [
            'service_type'      => 'CE',
            'service_type_name' => 'CE - Obchodní balík do zahraničí',
            'services'          => [
                [
                    'name' => 'Neskladně',
                    'code' => '10',
                ],
                [
                    'name' => 'Zboží s VDD (pouze pro zásilky do ciziny s celní zónou)',
                    'code' => '44',
                ],
            ],
        ];
        $expectedResult = new ServiceModel('DR', null, options: new ServiceOptionCollection([
            new ServiceOption(
                '10',
                'Neskladně',
            ),
            new ServiceOption(
                '44',
                'Zboží s VDD (pouze pro zásilky do ciziny s celní zónou)',
            ),
        ]));

        $service = $this->newDefaultSettingService(
            client: $this->mockClient([VersionType::V2V1, $carrier, Request::ADD_SERVICE_OPTIONS, [], $serviceType->getValue()], $response),
            serviceFactory: $this->mockServiceFactory($carrier, $response, $expectedResult),
        );

        $actualResult = $service->getAddServiceOptionsForService($carrier, $serviceType);

        self::assertSame($expectedResult, $actualResult);
    }

    /**
     * @param array<mixed>        $arguments
     * @param array<string,mixed> $response
     */
    private function mockClient(array $arguments, array $response): Client
    {
        $arguments = array_replace([
            null,
            null,
            null,
            [],
            null,
            true,
            false,
        ], $arguments);

        $client = $this->createMock(Client::class);
        $client->expects(self::once())->method('call')->with(...$arguments)->willReturn($response);

        return $client;
    }

    /**
     * @param array<string,mixed> $data
     */
    private function mockServiceFactory(Carrier $carrier, array $data, ServiceCollection|Service $response): ServiceFactory
    {
        $serviceFactory = $this->createMock(ServiceFactory::class);
        $serviceFactory->expects(self::once())->method($response instanceof Service ? 'create' : 'createCollection')->with($carrier, $data)
                       ->willReturn($response);

        return $serviceFactory;
    }

    /**
     * @param array<string,mixed> $data
     */
    private function mockUnitFactory(Carrier $carrier, array $data, UnitCollection $response): UnitFactory
    {
        $serviceFactory = $this->createMock(UnitFactory::class);
        $serviceFactory->expects(self::once())->method('createCollection')->with($carrier, $data)->willReturn($response);

        return $serviceFactory;
    }

    /**
     * @param array<string,mixed> $data
     */
    private function mockCountryFactory(array $data, CountryCollection $response): CountryFactory
    {
        $serviceFactory = $this->createMock(CountryFactory::class);
        $serviceFactory->expects(self::once())->method('createCollection')->with($data)->willReturn($response);

        return $serviceFactory;
    }

    /**
     * @param array<string,mixed>                                   $data
     * @param iterable<\Inspirum\Balikobot\Model\PostCode\PostCode> $response
     */
    private function mockPostCodeFactory(
        Carrier $carrier,
        Service $service,
        ?string $country,
        array $data,
        iterable $response
    ): PostCodeFactory {
        $serviceFactory = $this->createMock(PostCodeFactory::class);
        $serviceFactory->expects(self::once())->method('createIterator')->with($carrier, $service, $country, $data)->willReturn($response);

        return $serviceFactory;
    }

    /**
     * @param array<string,mixed> $data
     */
    private function mockAdrUnitFactory(Carrier $carrier, array $data, AdrUnitCollection $response): AdrUnitFactory
    {
        $serviceFactory = $this->createMock(AdrUnitFactory::class);
        $serviceFactory->expects(self::once())->method('createCollection')->with($carrier, $data)->willReturn($response);

        return $serviceFactory;
    }

    /**
     * @param array<string,mixed> $data
     */
    private function mockAttributeFactory(Carrier $carrier, array $data, AttributeCollection $response): AttributeFactory
    {
        $serviceFactory = $this->createMock(AttributeFactory::class);
        $serviceFactory->expects(self::once())->method('createCollection')->with($carrier, $data)->willReturn($response);

        return $serviceFactory;
    }

    private function newDefaultSettingService(
        Client $client,
        ?ServiceFactory $serviceFactory = null,
        ?UnitFactory $unitFactory = null,
        ?CountryFactory $countryFactory = null,
        ?PostCodeFactory $postCodeFactory = null,
        ?AdrUnitFactory $adrUnitFactory = null,
        ?AttributeFactory $attributeFactory = null,
    ): DefaultSettingService {
        return new DefaultSettingService(
            $client,
            $serviceFactory ?? $this->createMock(ServiceFactory::class),
            $unitFactory ?? $this->createMock(UnitFactory::class),
            $countryFactory ?? $this->createMock(CountryFactory::class),
            $postCodeFactory ?? $this->createMock(PostCodeFactory::class),
            $adrUnitFactory ?? $this->createMock(AdrUnitFactory::class),
            $attributeFactory ?? $this->createMock(AttributeFactory::class),
        );
    }
}
