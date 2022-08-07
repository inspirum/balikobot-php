<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Service;

use ArrayIterator;
use Inspirum\Balikobot\Client\Client;
use Inspirum\Balikobot\Definitions\Carrier;
use Inspirum\Balikobot\Definitions\Country;
use Inspirum\Balikobot\Definitions\Method;
use Inspirum\Balikobot\Definitions\Service;
use Inspirum\Balikobot\Definitions\Version;
use Inspirum\Balikobot\Model\Branch\Branch;
use Inspirum\Balikobot\Model\Branch\BranchFactory;
use Inspirum\Balikobot\Model\Branch\BranchResolver;
use Inspirum\Balikobot\Model\Branch\DefaultBranchIterator;
use Inspirum\Balikobot\Provider\CarrierProvider;
use Inspirum\Balikobot\Provider\ServiceProvider;
use Inspirum\Balikobot\Service\DefaultBranchService;
use Traversable;
use function array_map;
use function array_merge;
use function array_values;
use function count;
use function iterator_to_array;
use function sprintf;

final class DefaultBranchServiceTest extends BaseServiceTestCase
{
    public function testGetBranches(): void
    {
        $carriers  = [
            Carrier::CP,
            Carrier::ZASILKOVNA,
        ];
        $services  = [
            [
                Service::CP_NP,
                Service::CP_RR,
            ],
            [
                Service::ZASILKOVNA_VMCZ,
                Service::ZASILKOVNA_VMHU,
            ],
        ];
        $responses = [
            $this->mockClientResponse(),
            $this->mockClientResponse(),
            $this->mockClientResponse(),
            $this->mockClientResponse(),
        ];
        $items     = [
            [
                $this->mockBranch(),
            ],
            [],
            [
                $this->mockBranch(Country::CZECH_REPUBLIC),
                $this->mockBranch(Country::CZECH_REPUBLIC),
            ],
            [
                $this->mockBranch(Country::HUNGARY),
                $this->mockBranch(Country::HUNGARY),
            ],
        ];

        $branchService = $this->newDefaultBranchService(
            client: $this->mockClientMultipleCalls([
                [
                    Version::V2V1,
                    $carriers[0],
                    Method::BRANCHES,
                    [],
                    sprintf('service/%s', $services[0][0]),
                    true,
                    true,
                ],
                [
                    Version::V2V1,
                    $carriers[0],
                    Method::BRANCHES,
                    [],
                    sprintf('service/%s', $services[0][1]),
                    true,
                    true,
                ],
                [
                    Version::V2V1,
                    $carriers[1],
                    Method::FULL_BRANCHES,
                    [],
                    sprintf('service/%s', $services[1][0]),
                    true,
                    true,
                ],
                [
                    Version::V2V1,
                    $carriers[1],
                    Method::FULL_BRANCHES,
                    [],
                    sprintf('service/%s', $services[1][1]),
                    true,
                    true,
                ],
            ], $responses),
            carrierProvider: $this->mockCarrierProvider($carriers),
            serviceProvider: $this->mockServiceProvider($carriers, $services),
            branchFactory: $this->mockBranchFactory([
                [$carriers[0], $services[0][0], null, $responses[0]],
                [$carriers[0], $services[0][1], null, $responses[1]],
                [$carriers[1], $services[1][0], null, $responses[2]],
                [$carriers[1], $services[1][1], null, $responses[3]],
            ], [
                new DefaultBranchIterator($carriers[0], $services[0][0], null, new ArrayIterator($items[0])),
                new DefaultBranchIterator($carriers[0], $services[0][1], null, new ArrayIterator($items[1])),
                new DefaultBranchIterator($carriers[1], $services[1][0], null, new ArrayIterator($items[2])),
                new DefaultBranchIterator($carriers[1], $services[1][1], null, new ArrayIterator($items[3])),
            ]),
            branchResolver: $this->mockBranchResolver([
                [$carriers[0], $services[0][0]],
                [$carriers[0], $services[0][1]],
                [$carriers[1], $services[1][0]],
                [$carriers[1], $services[1][1]],
            ], [
                false,
                false,
                true,
                true,
            ]),
        );

        $actualResult = $branchService->getBranches();

        $expectedResult = new ArrayIterator(array_values(array_merge(...$items)));

        self::assertSame(iterator_to_array($expectedResult), iterator_to_array($actualResult));
        self::assertSame(null, $actualResult->getCarrier());
        self::assertSame(null, $actualResult->getService());
        self::assertSame(null, $actualResult->getCountries());
    }

    public function testGetBranchesForCountries(): void
    {
        $carriers  = [
            Carrier::CP,
            Carrier::ZASILKOVNA,
        ];
        $services  = [
            [
                Service::CP_NP,
                Service::CP_RR,
            ],
            [
                Service::ZASILKOVNA_VMCZ,
                Service::ZASILKOVNA_VMHU,
            ],
        ];
        $countries = [
            Country::CZECH_REPUBLIC,
            Country::HUNGARY,
        ];
        $responses = [
            $this->mockClientResponse(),
            $this->mockClientResponse(),
            $this->mockClientResponse(),
            $this->mockClientResponse(),
            $this->mockClientResponse(),
            $this->mockClientResponse(),
        ];
        $items     = [
            [
                $this->mockBranch(Country::CZECH_REPUBLIC),
            ],
            [],
            [
                $this->mockBranch(Country::CZECH_REPUBLIC),
                $this->mockBranch(Country::HUNGARY),
                $this->mockBranch(Country::CZECH_REPUBLIC),
            ],
            [
                $this->mockBranch(Country::HUNGARY),
            ],
            [
                $this->mockBranch(Country::HUNGARY),
                $this->mockBranch(Country::AUSTRIA),
                $this->mockBranch(Country::HUNGARY),
            ],
            [
                $this->mockBranch(Country::CZECH_REPUBLIC),
                $this->mockBranch(Country::CZECH_REPUBLIC),
                $this->mockBranch(),
            ],
        ];

        $branchService = $this->newDefaultBranchService(
            client: $this->mockClientMultipleCalls([
                [
                    Version::V2V1,
                    $carriers[0],
                    Method::BRANCHES,
                    [],
                    sprintf('service/%s', $services[0][0]),
                    true,
                    true,
                ],
                [
                    Version::V2V1,
                    $carriers[0],
                    Method::BRANCHES,
                    [],
                    sprintf('service/%s', $services[0][1]),
                    true,
                    true,
                ],
                [
                    Version::V2V1,
                    $carriers[1],
                    Method::FULL_BRANCHES,
                    [],
                    sprintf('service/%s/country/%s', $services[1][0], $countries[0]),
                    true,
                    true,
                ],
                [
                    Version::V2V1,
                    $carriers[1],
                    Method::FULL_BRANCHES,
                    [],
                    sprintf('service/%s/country/%s', $services[1][0], $countries[1]),
                    true,
                    true,
                ],
                [
                    Version::V2V1,
                    $carriers[1],
                    Method::FULL_BRANCHES,
                    [],
                    sprintf('service/%s/country/%s', $services[1][1], $countries[0]),
                    true,
                    true,
                ],
                [
                    Version::V2V1,
                    $carriers[1],
                    Method::FULL_BRANCHES,
                    [],
                    sprintf('service/%s/country/%s', $services[1][1], $countries[1]),
                    true,
                    true,
                ],
            ], $responses),
            carrierProvider: $this->mockCarrierProvider($carriers),
            serviceProvider: $this->mockServiceProvider($carriers, $services),
            branchFactory: $this->mockBranchFactory([
                [$carriers[0], $services[0][0], null, $responses[0]],
                [$carriers[0], $services[0][1], null, $responses[1]],
                [$carriers[1], $services[1][0], [$countries[0]], $responses[2]],
                [$carriers[1], $services[1][0], [$countries[1]], $responses[3]],
                [$carriers[1], $services[1][1], [$countries[0]], $responses[4]],
                [$carriers[1], $services[1][1], [$countries[1]], $responses[5]],
            ], [
                new DefaultBranchIterator($carriers[0], $services[0][0], null, new ArrayIterator($items[0])),
                new DefaultBranchIterator($carriers[0], $services[0][1], null, new ArrayIterator($items[1])),
                new DefaultBranchIterator($carriers[1], $services[1][0], [$countries[0]], new ArrayIterator($items[2])),
                new DefaultBranchIterator($carriers[1], $services[1][0], [$countries[1]], new ArrayIterator($items[3])),
                new DefaultBranchIterator($carriers[1], $services[1][1], [$countries[0]], new ArrayIterator($items[4])),
                new DefaultBranchIterator($carriers[1], $services[1][1], [$countries[1]], new ArrayIterator($items[5])),
            ]),
            branchResolver: $this->mockBranchResolver([
                [$carriers[0], $services[0][0]],
                [$carriers[0], $services[0][1]],
                [$carriers[1], $services[1][0]],
                [$carriers[1], $services[1][0]],
                [$carriers[1], $services[1][1]],
                [$carriers[1], $services[1][1]],
            ], [
                false,
                false,
                true,
                true,
                true,
                true,
            ], [
                false,
                false,
                true,
                null,
                true,
                null,
            ]),
        );

        $actualResult = $branchService->getBranchesForCountries($countries);

        unset($items[4][1]);
        unset($items[5][2]);
        $expectedResult = new ArrayIterator(array_values(array_merge(...$items)));

        self::assertSame(iterator_to_array($expectedResult), iterator_to_array($actualResult));
        self::assertSame(null, $actualResult->getCarrier());
        self::assertSame(null, $actualResult->getService());
        self::assertSame($countries, $actualResult->getCountries());
    }

    public function testGetBranchesForCarrier(): void
    {
        $carrier   = Carrier::CP;
        $services  = [
            Service::CP_NP,
            Service::CP_RR,
            Service::CP_NB,
        ];
        $responses = [
            $this->mockClientResponse(),
            $this->mockClientResponse(),
            $this->mockClientResponse(),
        ];
        $items     = [
            [
                $this->mockBranch(),
            ],
            [
                $this->mockBranch(),
            ],
            [
                $this->mockBranch(Country::HUNGARY),
                $this->mockBranch(Country::CZECH_REPUBLIC),
                $this->mockBranch(Country::AUSTRIA),
                $this->mockBranch(Country::BURUNDI),
            ],
        ];

        $branchService = $this->newDefaultBranchService(
            client: $this->mockClientMultipleCalls([
                [
                    Version::V2V1,
                    $carrier,
                    Method::BRANCHES,
                    [],
                    sprintf('service/%s', $services[0]),
                    true,
                    true,
                ],
                [
                    Version::V2V1,
                    $carrier,
                    Method::FULL_BRANCHES,
                    [],
                    sprintf('service/%s', $services[1]),
                    true,
                    true,
                ],
                [
                    Version::V2V1,
                    $carrier,
                    Method::BRANCHES,
                    [],
                    sprintf('service/%s', $services[2]),
                    true,
                    true,
                ],
            ], $responses),
            serviceProvider: $this->mockServiceProvider([$carrier], [$services]),
            branchFactory: $this->mockBranchFactory([
                [$carrier, $services[0], null, $responses[0]],
                [$carrier, $services[1], null, $responses[1]],
                [$carrier, $services[2], null, $responses[2]],
            ], [
                new DefaultBranchIterator($carrier, $services[0], null, new ArrayIterator($items[0])),
                new DefaultBranchIterator($carrier, $services[1], null, new ArrayIterator($items[1])),
                new DefaultBranchIterator($carrier, $services[2], null, new ArrayIterator($items[2])),
            ]),
            branchResolver: $this->mockBranchResolver([
                [$carrier, $services[0]],
                [$carrier, $services[1]],
                [$carrier, $services[2]],
            ], [
                false,
                true,
                false,
            ]),
        );

        $actualResult = $branchService->getBranchesForCarrier($carrier);

        $expectedResult = new ArrayIterator(array_values(array_merge(...$items)));

        self::assertSame(iterator_to_array($expectedResult), iterator_to_array($actualResult));
        self::assertSame($carrier, $actualResult->getCarrier());
        self::assertSame(null, $actualResult->getService());
        self::assertSame(null, $actualResult->getCountries());
    }

    public function testGetBranchesForCarrierAndCountries(): void
    {
        $carrier   = Carrier::CP;
        $services  = [
            Service::CP_NP,
            Service::CP_RR,
            Service::CP_NB,
        ];
        $countries = [
            Country::HUNGARY,
            Country::AUSTRIA,
        ];
        $responses = [
            $this->mockClientResponse(),
            $this->mockClientResponse(),
            $this->mockClientResponse(),
            $this->mockClientResponse(),
        ];
        $items     = [
            [
                $this->mockBranch(Country::HUNGARY),
            ],
            [
                $this->mockBranch(Country::HUNGARY),
            ],
            [
                $this->mockBranch(Country::AUSTRIA),
            ],
            [
                $this->mockBranch(Country::HUNGARY),
                $this->mockBranch(Country::CZECH_REPUBLIC),
                $this->mockBranch(Country::AUSTRIA),
                $this->mockBranch(Country::AUSTRIA),
            ],
        ];

        $branchService = $this->newDefaultBranchService(
            client: $this->mockClientMultipleCalls([
                [
                    Version::V2V1,
                    $carrier,
                    Method::FULL_BRANCHES,
                    [],
                    sprintf('service/%s', $services[0]),
                    true,
                    true,
                ],
                [
                    Version::V2V1,
                    $carrier,
                    Method::BRANCHES,
                    [],
                    sprintf('service/%s/country/%s', $services[1], $countries[0]),
                    true,
                    true,
                ],
                [
                    Version::V2V1,
                    $carrier,
                    Method::BRANCHES,
                    [],
                    sprintf('service/%s/country/%s', $services[1], $countries[1]),
                    true,
                    true,
                ],
                [
                    Version::V2V1,
                    $carrier,
                    Method::FULL_BRANCHES,
                    [],
                    sprintf('service/%s', $services[2]),
                    true,
                    true,
                ],
            ], $responses),
            serviceProvider: $this->mockServiceProvider([$carrier], [$services]),
            branchFactory: $this->mockBranchFactory([
                [$carrier, $services[0], null, $responses[0]],
                [$carrier, $services[1], [$countries[0]], $responses[1]],
                [$carrier, $services[1], [$countries[1]], $responses[2]],
                [$carrier, $services[2], null, $responses[3]],
            ], [
                new DefaultBranchIterator($carrier, $services[0], null, new ArrayIterator($items[0])),
                new DefaultBranchIterator($carrier, $services[1], [$countries[0]], new ArrayIterator($items[1])),
                new DefaultBranchIterator($carrier, $services[1], [$countries[1]], new ArrayIterator($items[2])),
                new DefaultBranchIterator($carrier, $services[2], null, new ArrayIterator($items[3])),
            ]),
            branchResolver: $this->mockBranchResolver([
                [$carrier, $services[0]],
                [$carrier, $services[1]],
                [$carrier, $services[1]],
                [$carrier, $services[2]],
            ], [
                true,
                false,
                false,
                true,
            ], [
                false,
                true,
                null,
                false,
            ]),
        );

        $actualResult = $branchService->getBranchesForCarrierAndCountries($carrier, $countries);

        unset($items[3][1]);
        $expectedResult = new ArrayIterator(array_values(array_merge(...$items)));

        self::assertSame(iterator_to_array($expectedResult), iterator_to_array($actualResult));
        self::assertSame($carrier, $actualResult->getCarrier());
        self::assertSame(null, $actualResult->getService());
        self::assertSame($countries, $actualResult->getCountries());
    }

    public function testGetBranchesForCarrierService(): void
    {
        $carrier  = Carrier::CP;
        $service  = Service::CP_NP;
        $response = $this->mockClientResponse();
        $items    = [
            $this->mockBranch(),
            $this->mockBranch(),
            $this->mockBranch(),
        ];

        $branchService = $this->newDefaultBranchService(
            client: $this->mockClient([
                Version::V2V1,
                $carrier,
                Method::FULL_BRANCHES,
                [],
                sprintf('service/%s', $service),
                true,
                true,
            ], $response),
            branchFactory: $this->mockBranchFactory([
                [$carrier, $service, null, $response],
            ], [
                new DefaultBranchIterator($carrier, $service, null, new ArrayIterator($items)),
            ]),
            branchResolver: $this->mockBranchResolver([
                [$carrier, $service],
            ], [
                true,
            ]),
        );

        $actualResult   = $branchService->getBranchesForCarrierService($carrier, $service);
        $expectedResult = new ArrayIterator($items);

        self::assertSame(iterator_to_array($expectedResult), iterator_to_array($actualResult));
        self::assertSame($carrier, $actualResult->getCarrier());
        self::assertSame($service, $actualResult->getService());
        self::assertSame(null, $actualResult->getCountries());
    }

    public function testGetBranchesForCarrierServiceAndCountries(): void
    {
        $carrier   = Carrier::CP;
        $service   = Service::CP_NP;
        $countries = [
            Country::CZECH_REPUBLIC,
            Country::SLOVAKIA,
        ];
        $response  = $this->mockClientResponse();
        $items     = [
            $this->mockBranch(Country::CZECH_REPUBLIC),
            $this->mockBranch(Country::CZECH_REPUBLIC),
            $this->mockBranch(Country::GREENLAND),
            $this->mockBranch(Country::SLOVAKIA),
        ];

        $branchService = $this->newDefaultBranchService(
            client: $this->mockClient([
                Version::V2V1,
                $carrier,
                Method::FULL_BRANCHES,
                [],
                sprintf('service/%s', $service),
                true,
                true,
            ], $response),
            branchFactory: $this->mockBranchFactory([
                [$carrier, $service, null, $response],
            ], [
                new DefaultBranchIterator($carrier, $service, null, new ArrayIterator($items)),
            ]),
            branchResolver: $this->mockBranchResolver([
                [$carrier, $service],
            ], [
                true,
            ], [
                false,
            ]),
        );

        $actualResult = $branchService->getBranchesForCarrierServiceAndCountries($carrier, $service, $countries);

        unset($items[2]);
        $expectedResult = new ArrayIterator(array_values($items));

        self::assertSame(iterator_to_array($expectedResult), iterator_to_array($actualResult));
        self::assertSame($carrier, $actualResult->getCarrier());
        self::assertSame($service, $actualResult->getService());
        self::assertSame($countries, $actualResult->getCountries());
    }

    public function testGetBranchesForCarrierServiceAndCountriesWithCountryFilterSupport(): void
    {
        $carrier   = Carrier::CP;
        $service   = Service::CP_NP;
        $countries = [
            Country::CZECH_REPUBLIC,
            Country::SLOVAKIA,
        ];
        $responses = [
            $this->mockClientResponse(),
            $this->mockClientResponse(),
        ];
        $items     = [
            [
                $this->mockBranch(Country::CZECH_REPUBLIC),
                $this->mockBranch(Country::CZECH_REPUBLIC),
                $this->mockBranch(),
            ],
            [
                $this->mockBranch(Country::SLOVAKIA),
            ],
        ];

        $branchService = $this->newDefaultBranchService(
            client: $this->mockClientMultipleCalls([
                [
                    Version::V2V1,
                    $carrier,
                    Method::BRANCHES,
                    [],
                    sprintf('service/%s/country/%s', $service, $countries[0]),
                    true,
                    true,
                ],
                [
                    Version::V2V1,
                    $carrier,
                    Method::BRANCHES,
                    [],
                    sprintf('service/%s/country/%s', $service, $countries[1]),
                    true,
                    true,
                ],
            ], $responses),
            branchFactory: $this->mockBranchFactory([
                [$carrier, $service, [$countries[0]], $responses[0]],
                [$carrier, $service, [$countries[1]], $responses[1]],
            ], [
                new DefaultBranchIterator($carrier, $service, [$countries[0]], new ArrayIterator($items[0])),
                new DefaultBranchIterator($carrier, $service, [$countries[1]], new ArrayIterator($items[1])),
            ]),
            branchResolver: $this->mockBranchResolver([
                [$carrier, $service],
                [$carrier, $service],
            ], [
                false,
                false,
            ], [
                true,
                null,
            ]),
        );

        $actualResult = $branchService->getBranchesForCarrierServiceAndCountries($carrier, $service, $countries);

        unset($items[0][2]);
        $expectedResult = new ArrayIterator(array_merge(...$items));

        self::assertSame(iterator_to_array($expectedResult), iterator_to_array($actualResult));
        self::assertSame($carrier, $actualResult->getCarrier());
        self::assertSame($service, $actualResult->getService());
        self::assertSame($countries, $actualResult->getCountries());
    }

    public function testGetBranchesForLocation(): void
    {
        $carrier  = Carrier::UPS;
        $country  = Country::CZECH_REPUBLIC;
        $city     = 'Prague';
        $response = $this->mockClientResponse();
        $items    = [
            $this->mockBranch(Country::CZECH_REPUBLIC),
            $this->mockBranch(Country::CZECH_REPUBLIC),
            $this->mockBranch(),
        ];

        $branchService = $this->newDefaultBranchService(
            client: $this->mockClient([
                Version::V2V1,
                $carrier,
                Method::BRANCH_LOCATOR,
                [
                    'country' => $country,
                    'city'    => $city,
                ],
            ], $response),
            branchFactory: $this->mockBranchFactory([
                [$carrier, null, [$country], $response],
            ], [
                new DefaultBranchIterator($carrier, null, [$country], new ArrayIterator($items)),
            ]),
        );

        $actualResult = $branchService->getBranchesForLocation($carrier, $country, $city);

        $expectedResult = new ArrayIterator($items);

        self::assertSame(iterator_to_array($expectedResult), iterator_to_array($actualResult));
        self::assertSame($carrier, $actualResult->getCarrier());
        self::assertSame(null, $actualResult->getService());
        self::assertSame([$country], $actualResult->getCountries());
    }

    private function mockBranch(?string $country = null): Branch
    {
        $branch = $this->createMock(Branch::class);
        if ($country !== null) {
            $branch->expects(self::any())->method('getCountry')->willReturn($country);
        }

        return $branch;
    }

    /**
     * @param array<array<string|array<string>|array<string,mixed>|null>> $arguments
     * @param array<\Inspirum\Balikobot\Model\Branch\BranchIterator>      $responses
     */
    private function mockBranchFactory(array $arguments, array $responses): BranchFactory
    {
        $branchFactory = $this->createMock(BranchFactory::class);
        $branchFactory->expects(self::exactly(count($arguments)))->method('createIterator')
                      ->withConsecutive(...$arguments)
                      ->willReturnOnConsecutiveCalls(...$responses);

        $branchFactory->expects(self::any())->method('wrapIterator')
                      ->willReturnCallback(static function (?string $carrier, ?string $service, ?array $countries, Traversable $iterator) {
                          return new DefaultBranchIterator($carrier, $service, $countries, $iterator);
                      });

        return $branchFactory;
    }

    /**
     * @param array<array{0:string,1:string|null}> $arguments
     * @param array<bool>                          $fullBranchSupport
     * @param array<bool|null>|null                $countryFilterSupports
     */
    private function mockBranchResolver(
        array $arguments,
        array $fullBranchSupport,
        ?array $countryFilterSupports = null
    ): BranchResolver {
        $branchResolver = $this->createMock(BranchResolver::class);
        $branchResolver->expects(self::exactly(count($arguments)))->method('hasFullBranchesSupport')
                       ->withConsecutive(...$arguments)
                       ->willReturnOnConsecutiveCalls(...$fullBranchSupport);

        if ($countryFilterSupports !== null) {
            $countryFilterArguments = [];
            $countryFilterValues    = [];
            foreach ($countryFilterSupports as $i => $countryFilterSupport) {
                if ($countryFilterSupport === null) {
                    continue;
                }

                $countryFilterArguments[] = $arguments[$i];
                $countryFilterValues[]    = $countryFilterSupport;
            }

            $branchResolver->expects(self::exactly(count($countryFilterArguments)))->method('hasBranchCountryFilterSupport')
                           ->withConsecutive(...$countryFilterArguments)
                           ->willReturnOnConsecutiveCalls(...$countryFilterValues);
        }

        return $branchResolver;
    }

    /**
     * @param array<string>        $arguments
     * @param array<array<string>> $responses
     */
    private function mockServiceProvider(array $arguments, array $responses): ServiceProvider
    {
        $settingService = $this->createMock(ServiceProvider::class);
        $settingService->expects(self::exactly(count($arguments)))
                       ->method('getServices')
                       ->withConsecutive(...array_map(static fn(string $carrier): array => [$carrier], $arguments))
                       ->willReturnOnConsecutiveCalls(...$responses);

        return $settingService;
    }

    /**
     * @param array<string> $response
     */
    private function mockCarrierProvider(array $response): CarrierProvider
    {
        $settingService = $this->createMock(CarrierProvider::class);
        $settingService->expects(self::once())->method('getCarriers')->willReturn($response);

        return $settingService;
    }

    private function newDefaultBranchService(
        Client $client,
        ?BranchFactory $branchFactory = null,
        ?BranchResolver $branchResolver = null,
        ?CarrierProvider $carrierProvider = null,
        ?ServiceProvider $serviceProvider = null,
    ): DefaultBranchService {
        return new DefaultBranchService(
            $client,
            $branchFactory ?? $this->createMock(BranchFactory::class),
            $branchResolver ?? $this->createMock(BranchResolver::class),
            $carrierProvider ?? $this->createMock(CarrierProvider::class),
            $serviceProvider ?? $this->createMock(ServiceProvider::class),
        );
    }
}
