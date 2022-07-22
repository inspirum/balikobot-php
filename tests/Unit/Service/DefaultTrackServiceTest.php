<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Service;

use DateTimeImmutable;
use Inspirum\Balikobot\Client\Client;
use Inspirum\Balikobot\Definitions\Request;
use Inspirum\Balikobot\Definitions\VersionType;
use Inspirum\Balikobot\Model\Carrier\Carrier;
use Inspirum\Balikobot\Model\Package\Package;
use Inspirum\Balikobot\Model\Package\PackageCollection;
use Inspirum\Balikobot\Model\Status\Status;
use Inspirum\Balikobot\Model\Status\StatusCollection;
use Inspirum\Balikobot\Model\Status\StatusFactory;
use Inspirum\Balikobot\Model\Status\Statuses;
use Inspirum\Balikobot\Model\Status\StatusesCollection;
use Inspirum\Balikobot\Service\DefaultTrackService;
use function array_map;

final class DefaultTrackServiceTest extends BaseServiceTest
{
    public function testTrackPackages(): void
    {
        $carrier        = Carrier::from('cp');
        $carrierIds     = ['1', '2'];
        $response       = [
            'packages' => [
                0 => [
                    'carrier_id' => '3',
                    'status'     => 200,
                    'states'     => [
                        [
                            'date'           => '2018-11-07 14:15:01',
                            'name'           => 'Doručování zásilky',
                            'status_id'      => 2,
                            'status_id_v2'   => 2.2,
                            'type'           => 'event',
                            'name_balikobot' => 'Zásilka je v přepravě.',
                        ],
                    ],
                ],
                1 => [
                    'carrier_id' => '4',
                    'status'     => 200,
                    'states'     => [
                        [
                            'date'           => '2018-11-07 14:15:01',
                            'name'           => 'Doručování zásilky',
                            'status_id'      => 2,
                            'status_id_v2'   => 2.2,
                            'type'           => 'event',
                            'name_balikobot' => 'Zásilka je v přepravě.',
                        ],
                    ],
                ],
            ],
        ];
        $expectedResult = new StatusesCollection(Carrier::from('cp'), [
            new Statuses(Carrier::from('cp'), '3', [
                new Status(
                    Carrier::from('cp'),
                    '3',
                    2.2,
                    'Zásilka je v přepravě.',
                    'Doručování zásilky',
                    'event',
                    new DateTimeImmutable('2018-11-07 14:15:01'),
                ),
            ]),
            new Statuses(Carrier::from('cp'), '4', [
                new Status(
                    Carrier::from('cp'),
                    '4',
                    2.2,
                    'Zásilka je v přepravě.',
                    'Doručování zásilky',
                    'event',
                    new DateTimeImmutable('2018-11-07 14:15:01'),
                ),
            ]),
        ]);

        $service = $this->newDefaultTrackService(
            client: $this->mockClient([VersionType::V2V2, $carrier, Request::TRACK, ['carrier_ids' => $carrierIds], null, false], $response),
            statusFactory: $this->mockStatusFactory($carrier, $carrierIds, $response, $expectedResult),
        );

        $actualResult = $service->trackPackagesByIds($carrier, $carrierIds);

        self::assertSame($expectedResult, $actualResult);

        $service = $this->newDefaultTrackService(
            client: $this->mockClient([VersionType::V2V2, $carrier, Request::TRACK, ['carrier_ids' => $carrierIds], null, false], $response),
            statusFactory: $this->mockStatusFactory($carrier, $carrierIds, $response, $expectedResult),
        );

        $actualResult = $service->trackPackages(new PackageCollection($carrier, array_map(static fn(string $carrierId): Package => new Package(
            $carrier,
            '1',
            '1',
            $carrierId,
        ), $carrierIds)));

        self::assertSame($expectedResult, $actualResult);
    }

    public function testTrackPackage(): void
    {
        $carrier        = Carrier::from('cp');
        $carrierId      = '3';
        $response       = [
            'packages' => [
                0 => [
                    'carrier_id' => '3',
                    'status'     => 200,
                    'states'     => [
                        [
                            'date'           => '2018-11-07 14:15:01',
                            'name'           => 'Doručování zásilky',
                            'status_id'      => 2,
                            'status_id_v2'   => 2.2,
                            'type'           => 'event',
                            'name_balikobot' => 'Zásilka je v přepravě.',
                        ],
                    ],
                ],
            ],
        ];
        $expectedResult = new StatusesCollection(Carrier::from('cp'), [
            new Statuses(Carrier::from('cp'), '3', [
                new Status(
                    Carrier::from('cp'),
                    '3',
                    2.2,
                    'Zásilka je v přepravě.',
                    'Doručování zásilky',
                    'event',
                    new DateTimeImmutable('2018-11-07 14:15:01'),
                ),
            ]),
        ]);

        $service = $this->newDefaultTrackService(
            client: $this->mockClient([VersionType::V2V2, $carrier, Request::TRACK, ['carrier_ids' => [$carrierId]], null, false], $response),
            statusFactory: $this->mockStatusFactory($carrier, [$carrierId], $response, $expectedResult),
        );

        $actualResult = $service->trackPackageById($carrier, $carrierId);

        self::assertSame($expectedResult->getForCarrierId('3'), $actualResult);

        $service = $this->newDefaultTrackService(
            client: $this->mockClient([VersionType::V2V2, $carrier, Request::TRACK, ['carrier_ids' => [$carrierId]], null, false], $response),
            statusFactory: $this->mockStatusFactory($carrier, [$carrierId], $response, $expectedResult),
        );

        $actualResult = $service->trackPackage(new Package(
            $carrier,
            '1',
            '1',
            $carrierId,
        ));

        self::assertSame($expectedResult->getForCarrierId('3'), $actualResult);
    }

    public function testTrackPackagesLastStatuses(): void
    {
        $carrier        = Carrier::from('cp');
        $carrierIds     = ['1', '2'];
        $response       = [
            'packages' => [
                0 => [
                    'carrier_id'  => '1',
                    'status'      => 200,
                    'status_id'   => 1.2,
                    'status_text' => 'Zásilka byla doručena příjemci.',
                ],
                1 => [
                    'carrier_id'  => '2',
                    'status'      => 200,
                    'status_id'   => 2.2,
                    'status_text' => 'Zásilka je v přepravě.',
                ],
            ],
        ];
        $expectedResult = new StatusCollection(
            Carrier::from('cp'),
            [
                new Status(
                    Carrier::from('cp'),
                    '1',
                    1.2,
                    'Zásilka byla doručena příjemci.',
                    'Zásilka byla doručena příjemci.',
                    'event',
                    null,
                ),
                new Status(
                    Carrier::from('cp'),
                    '2',
                    2.2,
                    'Zásilka je v přepravě.',
                    'Zásilka je v přepravě.',
                    'event',
                    null,
                ),
            ],
        );

        $service = $this->newDefaultTrackService(
            client: $this->mockClient([VersionType::V2V2, $carrier, Request::TRACK_STATUS, ['carrier_ids' => $carrierIds], null, false], $response),
            statusFactory: $this->mockStatusFactory($carrier, $carrierIds, $response, $expectedResult),
        );

        $actualResult = $service->trackPackagesLastStatusesByIds($carrier, $carrierIds);

        self::assertSame($expectedResult, $actualResult);

        $service = $this->newDefaultTrackService(
            client: $this->mockClient([VersionType::V2V2, $carrier, Request::TRACK_STATUS, ['carrier_ids' => $carrierIds], null, false], $response),
            statusFactory: $this->mockStatusFactory($carrier, $carrierIds, $response, $expectedResult),
        );

        $actualResult = $service->trackPackagesLastStatuses(new PackageCollection($carrier, array_map(static fn(string $carrierId): Package => new Package(
            $carrier,
            '1',
            '1',
            $carrierId,
        ), $carrierIds)));

        self::assertSame($expectedResult, $actualResult);
    }

    public function testTrackPackageLastStatus(): void
    {
        $carrier        = Carrier::from('cp');
        $carrierId      = '2';
        $response       = [
            'packages' => [
                [
                    'carrier_id'  => '2',
                    'status'      => 200,
                    'status_id'   => 2.2,
                    'status_text' => 'Zásilka je v přepravě.',
                ],
            ],
        ];
        $expectedResult = new StatusCollection(
            Carrier::from('cp'),
            [
                new Status(
                    Carrier::from('cp'),
                    '2',
                    2.2,
                    'Zásilka je v přepravě.',
                    'Zásilka je v přepravě.',
                    'event',
                    null,
                ),
            ],
        );

        $service = $this->newDefaultTrackService(
            client: $this->mockClient([VersionType::V2V2, $carrier, Request::TRACK_STATUS, ['carrier_ids' => [$carrierId]], null, false], $response),
            statusFactory: $this->mockStatusFactory($carrier, [$carrierId], $response, $expectedResult),
        );

        $actualResult = $service->trackPackageLastStatusById($carrier, $carrierId);

        self::assertSame($expectedResult->getForCarrierId('2'), $actualResult);

        $service = $this->newDefaultTrackService(
            client: $this->mockClient([VersionType::V2V2, $carrier, Request::TRACK_STATUS, ['carrier_ids' => [$carrierId]], null, false], $response),
            statusFactory: $this->mockStatusFactory($carrier, [$carrierId], $response, $expectedResult),
        );

        $actualResult = $service->trackPackageLastStatus(new Package(
            $carrier,
            '1',
            '1',
            $carrierId,
        ));

        self::assertSame($expectedResult->getForCarrierId('2'), $actualResult);
    }

    /**
     * @param array<string>       $carrierIds
     * @param array<string,mixed> $data
     */
    private function mockStatusFactory(Carrier $carrier, array $carrierIds, array $data, StatusesCollection|StatusCollection $response): StatusFactory
    {
        $serviceFactory = $this->createMock(StatusFactory::class);
        $serviceFactory->expects(self::once())
                       ->method($response instanceof StatusCollection ? 'createLastStatusCollection' : 'createCollection')
                       ->with($carrier, $carrierIds, $data)
                       ->willReturn($response);

        return $serviceFactory;
    }

    private function newDefaultTrackService(
        Client $client,
        ?StatusFactory $statusFactory = null,
    ): DefaultTrackService {
        return new DefaultTrackService(
            $client,
            $statusFactory ?? $this->createMock(StatusFactory::class),
        );
    }
}
