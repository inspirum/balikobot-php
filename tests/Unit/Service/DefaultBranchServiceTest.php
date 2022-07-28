<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Service;

use ArrayIterator;
use Inspirum\Balikobot\Client\Client;
use Inspirum\Balikobot\Definitions\Country;
use Inspirum\Balikobot\Definitions\RequestType;
use Inspirum\Balikobot\Definitions\VersionType;
use Inspirum\Balikobot\Model\Branch\Branch;
use Inspirum\Balikobot\Model\Branch\BranchFactory;
use Inspirum\Balikobot\Model\Branch\BranchResolver;
use Inspirum\Balikobot\Provider\CarrierProvider;
use Inspirum\Balikobot\Provider\ServiceProvider;
use Inspirum\Balikobot\Service\DefaultBranchService;
use function array_map;
use function array_merge;
use function array_values;
use function count;
use function iterator_to_array;

final class DefaultBranchServiceTest extends BaseServiceTest
{
    public function testGetBranches(): void
    {
        $carriers     = [
            'cp',
            'zasilkovna',
        ];
        $serviceTypes = [
            [
                'NP',
                'RR',
            ],
            [
                'VMCZ',
                'VMHU',
            ],
        ];
        $responses    = [
            $this->mockClientResponse(),
            $this->mockClientResponse(),
            $this->mockClientResponse(),
            $this->mockClientResponse(),
        ];
        $items        = [
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

        $service = $this->newDefaultBranchService(
            client: $this->mockClientMultipleCalls([
                [
                    VersionType::V2V1,
                    $carriers[0],
                    RequestType::BRANCHES,
                    [],
                    'service/NP',
                    true,
                    true,
                ],
                [
                    VersionType::V2V1,
                    $carriers[0],
                    RequestType::BRANCHES,
                    [],
                    'service/RR',
                    true,
                    true,
                ],
                [
                    VersionType::V2V1,
                    $carriers[1],
                    RequestType::FULL_BRANCHES,
                    [],
                    'service/VMCZ',
                    true,
                    true,
                ],
                [
                    VersionType::V2V1,
                    $carriers[1],
                    RequestType::FULL_BRANCHES,
                    [],
                    'service/VMHU',
                    true,
                    true,
                ],
            ], $responses),
            carrierProvider: $this->mockCarrierProvider($carriers),
            serviceProvider: $this->mockServiceProvider($carriers, $serviceTypes),
            branchFactory: $this->mockBranchFactory([
                [$carriers[0], $serviceTypes[0][0], $responses[0]],
                [$carriers[0], $serviceTypes[0][1], $responses[1]],
                [$carriers[1], $serviceTypes[1][0], $responses[2]],
                [$carriers[1], $serviceTypes[1][1], $responses[3]],
            ], [
                new ArrayIterator($items[0]),
                new ArrayIterator($items[1]),
                new ArrayIterator($items[2]),
                new ArrayIterator($items[3]),
            ]),
            branchResolver: $this->mockBranchResolver([
                [$carriers[0], $serviceTypes[0][0]],
                [$carriers[0], $serviceTypes[0][1]],
                [$carriers[1], $serviceTypes[1][0]],
                [$carriers[1], $serviceTypes[1][1]],
            ], [
                false,
                false,
                true,
                true,
            ]),
        );

        $actualResult = $service->getBranches();

        $expectedResult = new ArrayIterator(array_values(array_merge(...$items)));

        self::assertSame(iterator_to_array($expectedResult), iterator_to_array($actualResult));
    }

    public function testGetBranchesForCountries(): void
    {
        $carriers     = [
            'cp',
            'zasilkovna',
        ];
        $serviceTypes = [
            [
                'NP',
                'RR',
            ],
            [
                'VMCZ',
                'VMHU',
            ],
        ];
        $countries    = [
            Country::CZECH_REPUBLIC,
            Country::HUNGARY,
        ];
        $responses    = [
            $this->mockClientResponse(),
            $this->mockClientResponse(),
            $this->mockClientResponse(),
            $this->mockClientResponse(),
            $this->mockClientResponse(),
            $this->mockClientResponse(),
        ];
        $items        = [
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

        $service = $this->newDefaultBranchService(
            client: $this->mockClientMultipleCalls([
                [
                    VersionType::V2V1,
                    $carriers[0],
                    RequestType::BRANCHES,
                    [],
                    'service/NP',
                    true,
                    true,
                ],
                [
                    VersionType::V2V1,
                    $carriers[0],
                    RequestType::BRANCHES,
                    [],
                    'service/RR',
                    true,
                    true,
                ],
                [
                    VersionType::V2V1,
                    $carriers[1],
                    RequestType::FULL_BRANCHES,
                    [],
                    'service/VMCZ/country/CZ',
                    true,
                    true,
                ],
                [
                    VersionType::V2V1,
                    $carriers[1],
                    RequestType::FULL_BRANCHES,
                    [],
                    'service/VMCZ/country/HU',
                    true,
                    true,
                ],
                [
                    VersionType::V2V1,
                    $carriers[1],
                    RequestType::FULL_BRANCHES,
                    [],
                    'service/VMHU/country/CZ',
                    true,
                    true,
                ],
                [
                    VersionType::V2V1,
                    $carriers[1],
                    RequestType::FULL_BRANCHES,
                    [],
                    'service/VMHU/country/HU',
                    true,
                    true,
                ],
            ], $responses),
            carrierProvider: $this->mockCarrierProvider($carriers),
            serviceProvider: $this->mockServiceProvider($carriers, $serviceTypes),
            branchFactory: $this->mockBranchFactory([
                [$carriers[0], $serviceTypes[0][0], $responses[0]],
                [$carriers[0], $serviceTypes[0][1], $responses[1]],
                [$carriers[1], $serviceTypes[1][0], $responses[2]],
                [$carriers[1], $serviceTypes[1][0], $responses[3]],
                [$carriers[1], $serviceTypes[1][1], $responses[4]],
                [$carriers[1], $serviceTypes[1][1], $responses[5]],
            ], [
                new ArrayIterator($items[0]),
                new ArrayIterator($items[1]),
                new ArrayIterator($items[2]),
                new ArrayIterator($items[3]),
                new ArrayIterator($items[4]),
                new ArrayIterator($items[5]),
            ]),
            branchResolver: $this->mockBranchResolver([
                [$carriers[0], $serviceTypes[0][0]],
                [$carriers[0], $serviceTypes[0][1]],
                [$carriers[1], $serviceTypes[1][0]],
                [$carriers[1], $serviceTypes[1][0]],
                [$carriers[1], $serviceTypes[1][1]],
                [$carriers[1], $serviceTypes[1][1]],
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

        // array<int, array<int, array<string, mixed> >>,
        // array<int, array<int, array<string, mixed>|string>> given.
        $actualResult = $service->getBranchesForCountries($countries);

        unset($items[4][1]);
        unset($items[5][2]);
        $expectedResult = new ArrayIterator(array_values(array_merge(...$items)));

        self::assertSame(iterator_to_array($expectedResult), iterator_to_array($actualResult));
    }

    public function testGetBranchesForCarrier(): void
    {
        $carrier      = 'cp';
        $serviceTypes = [
            'NP',
            'RR',
            'NB',
        ];
        $responses    = [
            $this->mockClientResponse(),
            $this->mockClientResponse(),
            $this->mockClientResponse(),
        ];
        $items        = [
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

        $service = $this->newDefaultBranchService(
            client: $this->mockClientMultipleCalls([
                [
                    VersionType::V2V1,
                    $carrier,
                    RequestType::BRANCHES,
                    [],
                    'service/NP',
                    true,
                    true,
                ],
                [
                    VersionType::V2V1,
                    $carrier,
                    RequestType::FULL_BRANCHES,
                    [],
                    'service/RR',
                    true,
                    true,
                ],
                [
                    VersionType::V2V1,
                    $carrier,
                    RequestType::BRANCHES,
                    [],
                    'service/NB',
                    true,
                    true,
                ],
            ], $responses),
            serviceProvider: $this->mockServiceProvider([$carrier], [$serviceTypes]),
            branchFactory: $this->mockBranchFactory([
                [$carrier, $serviceTypes[0], $responses[0]],
                [$carrier, $serviceTypes[1], $responses[1]],
                [$carrier, $serviceTypes[2], $responses[2]],
            ], [
                new ArrayIterator($items[0]),
                new ArrayIterator($items[1]),
                new ArrayIterator($items[2]),
            ]),
            branchResolver: $this->mockBranchResolver([
                [$carrier, $serviceTypes[0]],
                [$carrier, $serviceTypes[1]],
                [$carrier, $serviceTypes[2]],
            ], [
                false,
                true,
                false,
            ]),
        );

        $actualResult = $service->getBranchesForCarrier($carrier);

        $expectedResult = new ArrayIterator(array_values(array_merge(...$items)));

        self::assertSame(iterator_to_array($expectedResult), iterator_to_array($actualResult));
    }

    public function testGetBranchesForCarrierAndCountries(): void
    {
        $carrier      = 'cp';
        $serviceTypes = [
            'NP',
            'RR',
            'NB',
        ];
        $countries    = [
            Country::HUNGARY,
            Country::AUSTRIA,
        ];
        $responses    = [
            $this->mockClientResponse(),
            $this->mockClientResponse(),
            $this->mockClientResponse(),
            $this->mockClientResponse(),
        ];
        $items        = [
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

        $service = $this->newDefaultBranchService(
            client: $this->mockClientMultipleCalls([
                [
                    VersionType::V2V1,
                    $carrier,
                    RequestType::FULL_BRANCHES,
                    [],
                    'service/NP',
                    true,
                    true,
                ],
                [
                    VersionType::V2V1,
                    $carrier,
                    RequestType::BRANCHES,
                    [],
                    'service/RR/country/HU',
                    true,
                    true,
                ],
                [
                    VersionType::V2V1,
                    $carrier,
                    RequestType::BRANCHES,
                    [],
                    'service/RR/country/AT',
                    true,
                    true,
                ],
                [
                    VersionType::V2V1,
                    $carrier,
                    RequestType::FULL_BRANCHES,
                    [],
                    'service/NB',
                    true,
                    true,
                ],
            ], $responses),
            serviceProvider: $this->mockServiceProvider([$carrier], [$serviceTypes]),
            branchFactory: $this->mockBranchFactory([
                [$carrier, $serviceTypes[0], $responses[0]],
                [$carrier, $serviceTypes[1], $responses[1]],
                [$carrier, $serviceTypes[1], $responses[2]],
                [$carrier, $serviceTypes[2], $responses[3]],
            ], [
                new ArrayIterator($items[0]),
                new ArrayIterator($items[1]),
                new ArrayIterator($items[2]),
                new ArrayIterator($items[3]),
            ]),
            branchResolver: $this->mockBranchResolver([
                [$carrier, $serviceTypes[0]],
                [$carrier, $serviceTypes[1]],
                [$carrier, $serviceTypes[1]],
                [$carrier, $serviceTypes[2]],
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

        $actualResult = $service->getBranchesForCarrierAndCountries($carrier, $countries);

        unset($items[3][1]);
        $expectedResult = new ArrayIterator(array_values(array_merge(...$items)));

        self::assertSame(iterator_to_array($expectedResult), iterator_to_array($actualResult));
    }

    public function testGetBranchesForCarrierService(): void
    {
        $carrier     = 'cp';
        $serviceType = 'NP';
        $response    = $this->mockClientResponse();
        $items       = [
            $this->mockBranch(),
            $this->mockBranch(),
            $this->mockBranch(),
        ];

        $service = $this->newDefaultBranchService(
            client: $this->mockClient([
                VersionType::V2V1,
                $carrier,
                RequestType::FULL_BRANCHES,
                [],
                'service/NP',
                true,
                true,
            ], $response),
            branchFactory: $this->mockBranchFactory([
                [$carrier, $serviceType, $response],
            ], [
                new ArrayIterator($items),
            ]),
            branchResolver: $this->mockBranchResolver([
                [$carrier, $serviceType],
            ], [
                true,
            ]),
        );

        $actualResult   = $service->getBranchesForCarrierService($carrier, $serviceType);
        $expectedResult = new ArrayIterator($items);

        self::assertSame(iterator_to_array($expectedResult), iterator_to_array($actualResult));
    }

    public function testGetBranchesForCarrierWithoutService(): void
    {
        $carrier     = 'cp';
        $serviceType = null;
        $response    = $this->mockClientResponse();
        $items       = [
            $this->mockBranch(),
            $this->mockBranch(),
            $this->mockBranch(),
        ];

        $service = $this->newDefaultBranchService(
            client: $this->mockClient([
                VersionType::V2V1,
                $carrier,
                RequestType::FULL_BRANCHES,
                [],
                '',
                true,
                true,
            ], $response),
            branchFactory: $this->mockBranchFactory([
                [$carrier, $serviceType, $response],
            ], [
                new ArrayIterator($items),
            ]),
            branchResolver: $this->mockBranchResolver([
                [$carrier, $serviceType],
            ], [
                true,
            ]),
        );

        $actualResult   = $service->getBranchesForCarrierService($carrier, $serviceType);
        $expectedResult = new ArrayIterator($items);

        self::assertSame(iterator_to_array($expectedResult), iterator_to_array($actualResult));
    }

    public function testGetBranchesForCarrierServiceAndCountries(): void
    {
        $carrier     = 'cp';
        $serviceType = 'NP';
        $countries   = [
            Country::CZECH_REPUBLIC,
            Country::SLOVAKIA,
        ];
        $response    = $this->mockClientResponse();
        $items       = [
            $this->mockBranch(Country::CZECH_REPUBLIC),
            $this->mockBranch(Country::CZECH_REPUBLIC),
            $this->mockBranch(Country::GREENLAND),
            $this->mockBranch(Country::SLOVAKIA),
        ];

        $service = $this->newDefaultBranchService(
            client: $this->mockClient([
                VersionType::V2V1,
                $carrier,
                RequestType::FULL_BRANCHES,
                [],
                'service/NP',
                true,
                true,
            ], $response),
            branchFactory: $this->mockBranchFactory([
                [$carrier, $serviceType, $response],
            ], [
                new ArrayIterator($items),
            ]),
            branchResolver: $this->mockBranchResolver([
                [$carrier, $serviceType],
            ], [
                true,
            ], [
                false,
            ]),
        );

        $actualResult = $service->getBranchesForCarrierServiceAndCountries($carrier, $serviceType, $countries);

        unset($items[2]);
        $expectedResult = new ArrayIterator(array_values($items));

        self::assertSame(iterator_to_array($expectedResult), iterator_to_array($actualResult));
    }

    public function testGetBranchesForCarrierServiceAndCountriesWithCountryFilterSupport(): void
    {
        $carrier     = 'cp';
        $serviceType = 'NP';
        $countries   = [
            Country::CZECH_REPUBLIC,
            Country::SLOVAKIA,
        ];
        $responses   = [
            $this->mockClientResponse(),
            $this->mockClientResponse(),
        ];
        $items       = [
            [
                $this->mockBranch(Country::CZECH_REPUBLIC),
                $this->mockBranch(Country::CZECH_REPUBLIC),
                $this->mockBranch(),
            ],
            [
                $this->mockBranch(Country::SLOVAKIA),
            ],
        ];

        $service = $this->newDefaultBranchService(
            client: $this->mockClientMultipleCalls([
                [
                    VersionType::V2V1,
                    $carrier,
                    RequestType::BRANCHES,
                    [],
                    'service/NP/country/CZ',
                    true,
                    true,
                ],
                [
                    VersionType::V2V1,
                    $carrier,
                    RequestType::BRANCHES,
                    [],
                    'service/NP/country/SK',
                    true,
                    true,
                ],
            ], $responses),
            branchFactory: $this->mockBranchFactory([
                [$carrier, $serviceType, $responses[0]],
                [$carrier, $serviceType, $responses[1]],
            ], [
                new ArrayIterator($items[0]),
                new ArrayIterator($items[1]),
            ]),
            branchResolver: $this->mockBranchResolver([
                [$carrier, $serviceType],
                [$carrier, $serviceType],
            ], [
                false,
                false,
            ], [
                true,
                null,
            ]),
        );

        $actualResult = $service->getBranchesForCarrierServiceAndCountries($carrier, $serviceType, $countries);

        unset($items[0][2]);
        $expectedResult = new ArrayIterator(array_merge(...$items));

        self::assertSame(iterator_to_array($expectedResult), iterator_to_array($actualResult));
    }

    public function testGetBranchesForLocation(): void
    {
        $carrier        = 'ups';
        $country        = Country::CZECH_REPUBLIC;
        $city           = 'Prague';
        $response       = $this->mockClientResponse();
        $expectedResult = $this->createMock(ArrayIterator::class);

        $service = $this->newDefaultBranchService(
            client: $this->mockClient([
                VersionType::V2V1,
                $carrier,
                RequestType::BRANCH_LOCATOR,
                [
                    'country' => $country,
                    'city'    => $city,
                ],
            ], $response),
            branchFactory: $this->mockBranchFactory([[$carrier, null, $response]], [$expectedResult]),
        );

        $actualResult = $service->getBranchesForLocation($carrier, $country, $city);

        self::assertSame($expectedResult, $actualResult);
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
     * @param array<array<(string|array<string, mixed>|null)>>         $arguments
     * @param array<iterable<\Inspirum\Balikobot\Model\Branch\Branch>> $responses
     */
    private function mockBranchFactory(array $arguments, array $responses): BranchFactory
    {
        $branchFactory = $this->createMock(BranchFactory::class);
        $branchFactory->expects(self::exactly(count($arguments)))->method('createIterator')
                      ->withConsecutive(...$arguments)
                      ->willReturnOnConsecutiveCalls(...$responses);

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
