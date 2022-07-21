<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Service;

use DateTimeImmutable;
use Inspirum\Balikobot\Client\DefaultClient;
use Inspirum\Balikobot\Client\Request\Carrier;
use Inspirum\Balikobot\Client\Response\Validator;
use Inspirum\Balikobot\Definitions\CarrierType;
use Inspirum\Balikobot\Exception\BadRequestException;
use Inspirum\Balikobot\Model\Package\Package;
use Inspirum\Balikobot\Model\Package\PackageCollection;
use Inspirum\Balikobot\Model\Status\DefaultPackageStatusFactory;
use Inspirum\Balikobot\Model\Status\Status;
use Inspirum\Balikobot\Model\Status\StatusCollection;
use Inspirum\Balikobot\Model\Status\Statuses;
use Inspirum\Balikobot\Model\Status\StatusesCollection;
use Inspirum\Balikobot\Service\DefaultTrackService;
use Inspirum\Balikobot\Tests\BaseTestCase;
use Throwable;

final class DefaultTrackServiceTest extends BaseTestCase
{
    /**
     * @param array<mixed,mixed>      $response
     * @param array<string>           $carrierIds
     * @param array<mixed,mixed>|null $request
     *
     * @dataProvider providesTestTrackPackagesByIds
     */
    public function testTrackPackagesByIds(
        int $statusCode,
        array $response,
        Carrier $carrier,
        array $carrierIds,
        StatusesCollection|Throwable|null $result,
        ?array $request = null,
    ): void {
        if ($result instanceof Throwable) {
            $this->expectException($result::class);
            $this->expectExceptionMessage($result->getMessage());
        }

        $service = $this->newTrackService($statusCode, $response, $request);

        $res = $service->trackPackagesByIds($carrier, $carrierIds);

        if ($result !== null) {
            self::assertEquals($result, $res);
        }
    }

    /**
     * @return iterable<array<mixed,mixed>>
     */
    public function providesTestTrackPackagesByIds(): iterable
    {
        yield 'response_without_status' => [
            'statusCode' => 200,
            'response'   => [
                'packages' => [
                    0 => [
                        'carrier_id' => '1',
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
                            [
                                'date'           => '2018-11-08 18:00:00',
                                'name'           => 'Dodání zásilky. (77072 - Depo Olomouc 72)',
                                'status_id'      => 1,
                                'status_id_v2'   => 1.2,
                                'type'           => 'event',
                                'name_balikobot' => 'Zásilka byla doručena příjemci.',
                            ],
                        ],
                    ],
                ],
            ],
            'carrier'    => CarrierType::CP,
            'carrierIds' => ['1'],
            'result'     => new StatusesCollection(
                CarrierType::CP,
                [
                    new Statuses(CarrierType::CP, '1', [
                        new Status(
                            CarrierType::CP,
                            '1',
                            2.2,
                            'Zásilka je v přepravě.',
                            'Doručování zásilky',
                            'event',
                            new DateTimeImmutable('2018-11-07 14:15:01'),
                        ),
                        new Status(
                            CarrierType::CP,
                            '1',
                            1.2,
                            'Zásilka byla doručena příjemci.',
                            'Dodání zásilky. (77072 - Depo Olomouc 72)',
                            'event',
                            new DateTimeImmutable('2018-11-08 18:00:00'),
                        ),
                    ]),
                ]
            ),
        ];

        yield 'missing_data_error' => [
            'statusCode' => 200,
            'response'   => [
                'status' => 200,
            ],
            'carrier'    => CarrierType::CP,
            'carrierIds' => ['1', '2'],
            'result'     => new BadRequestException([], 400),
        ];

        yield 'valid_request' => [
            'statusCode' => 200,
            'response'   => [
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
                            [
                                'date'           => '2018-11-08 18:00:00',
                                'name'           => 'Dodání zásilky. (77072 - Depo Olomouc 72)',
                                'status_id'      => 1,
                                'status_id_v2'   => 1.2,
                                'type'           => 'event',
                                'name_balikobot' => 'Zásilka byla doručena příjemci.',
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
                    2 => [
                        'carrier_id' => '5',
                        'status'     => 200,
                        'states'     => [
                            [
                                'date'           => '2018-11-08 18:00:00',
                                'name'           => 'Dodání zásilky. (77072 - Depo Olomouc 72)',
                                'status_id'      => 1,
                                'status_id_v2'   => 1.2,
                                'type'           => 'event',
                                'name_balikobot' => 'Zásilka byla doručena příjemci.',
                            ],
                        ],
                    ],
                ],
            ],
            'carrier'    => CarrierType::CP,
            'carrierIds' => ['3', '4', '5'],
            'result'     => null,
            'request'    => [
                'https://apiv2.balikobot.cz/v2/cp/track',
                [
                    'carrier_ids' => [
                        '3',
                        '4',
                        '5',
                    ],
                ],
            ],
        ];

        yield 'package_index_error' => [
            'statusCode' => 200,
            'response'   => [
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
                            [
                                'date'           => '2018-11-08 18:00:00',
                                'name'           => 'Dodání zásilky. (77072 - Depo Olomouc 72)',
                                'status_id'      => 1,
                                'status_id_v2'   => 1.2,
                                'type'           => 'event',
                                'name_balikobot' => 'Zásilka byla doručena příjemci.',
                            ],
                        ],
                    ],
                    2 => [
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
                    3 => [
                        'carrier_id' => '5',
                        'status'     => 200,
                        'states'     => [
                            [
                                'date'           => '2018-11-08 18:00:00',
                                'name'           => 'Dodání zásilky. (77072 - Depo Olomouc 72)',
                                'status_id'      => 1,
                                'status_id_v2'   => 1.2,
                                'type'           => 'event',
                                'name_balikobot' => 'Zásilka byla doručena příjemci.',
                            ],
                        ],
                    ],
                ],
            ],
            'carrier'    => CarrierType::CP,
            'carrierIds' => ['3', '4', '5'],
            'result'     => new BadRequestException([], 400),
        ];

        yield 'package_index_missing_error' => [
            'statusCode' => 200,
            'response'   => [
                'status'   => 200,
                'packages' => [
                    1 => [
                        'carrier_id' => '3',
                        'status'     => 200,
                        'states'     => [
                            [
                                'date'           => '2018-11-07 14:15:01',
                                'name'           => 'Dodání zásilky. 10005 Depo Praha 701',
                                'status_id'      => 1,
                                'status_id_v2'   => 1.2,
                                'type'           => 'event',
                                'name_balikobot' => 'Zásilka byla doručena příjemci..',
                            ],
                        ],
                    ],
                ],
            ],
            'carrier'    => CarrierType::PPL,
            'carrierIds' => ['1', '3'],
            'result'     => new BadRequestException([], 400),
        ];

        yield 'package_status_error' => [
            'statusCode' => 200,
            'response'   => [
                'status'   => 200,
                'packages' => [
                    0 => [
                        'carrier_id' => '1',
                        'status'     => 200,
                        'states'     => [
                            [
                                'date'           => '2018-11-07 14:15:01',
                                'name'           => 'Dodání zásilky. 10005 Depo Praha 701',
                                'status_id'      => 1,
                                'status_id_v2'   => 1.2,
                                'type'           => 'event',
                                'name_balikobot' => 'Zásilka byla doručena příjemci..',
                            ],
                        ],
                    ],
                    1 => [
                        'carrier_id'     => '1234',
                        'status'         => 503,
                        'status_message' => 'Technologie dopravce je momentálně nedostupná. Zopakujte dotaz později.',
                    ],
                ],
            ],
            'carrier'    => CarrierType::PPL,
            'carrierIds' => ['1', '3'],
            'result'     => new BadRequestException([], 503),
        ];

        yield 'package_status_data_error' => [
            'statusCode' => 200,
            'response'   => [
                'status'   => 200,
                'packages' => [
                    0 => [
                        'carrier_id' => '1',
                        'status'     => 200,
                        'states'     => [
                            [
                                '404',
                            ],
                        ],
                    ],
                    1 => [
                        'carrier_id' => '2',
                        'status'     => 200,
                        'states'     => [
                            [
                                '404',
                            ],
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
            ],
            'carrier'    => CarrierType::CP,
            'carrierIds' => ['1', '2'],
            'result'     => new BadRequestException([], 400),
        ];
    }

    public function testTrackPackagesByIdsProxy(): void
    {
        $service = $this->createPartialMock(DefaultTrackService::class, ['trackPackagesByIds']);

        $expectedStatuses = [
            new StatusesCollection(
                CarrierType::PPL,
                [
                    new Statuses(CarrierType::PPL, '1234', [
                        new Status(CarrierType::PPL, '1234', 1.1, 'name', 'desc', 'event', new DateTimeImmutable()),
                    ]),
                ]
            ),
            new StatusesCollection(
                CarrierType::CP,
                [
                    new Statuses(CarrierType::CP, '3456', [
                        new Status(CarrierType::CP, '3456', 1.1, 'name', 'desc', 'event', new DateTimeImmutable()),
                    ]),
                ]
            ),
            new StatusesCollection(
                CarrierType::CP,
                [
                    new Statuses(CarrierType::CP, 'Z123', [
                        new Status(CarrierType::ZASILKOVNA, 'Z123', 1.1, 'name', 'desc', 'event', new DateTimeImmutable()),
                    ]),
                    new Statuses(CarrierType::CP, 'Z234', [
                        new Status(CarrierType::ZASILKOVNA, 'Z234', 2.0, 'name', 'desc', 'event', new DateTimeImmutable()),
                    ]),
                ]
            ),
        ];

        $service->expects(self::exactly(3))->method('trackPackagesByIds')->withConsecutive(
            [CarrierType::PPL, ['1234']],
            [CarrierType::CP, ['3456']],
            [CarrierType::ZASILKOVNA, ['Z123', 'Z234']],
        )->willReturn(...$expectedStatuses);

        $actualStatuses = $service->trackPackage(new Package(CarrierType::PPL, '1', '0001', '1234'));
        self::assertSame($expectedStatuses[0][0], $actualStatuses);

        $actualStatuses = $service->trackPackageById(CarrierType::CP, '3456');
        self::assertSame($expectedStatuses[1][0], $actualStatuses);

        $packages = new PackageCollection();
        $packages->add(new Package(CarrierType::ZASILKOVNA, '1', '0001', 'Z123'));
        $packages->add(new Package(CarrierType::ZASILKOVNA, '2', '0001', 'Z234'));

        $actualStatuses = $service->trackPackages($packages);
        self::assertSame($expectedStatuses[2], $actualStatuses);
    }

    /**
     * @param array<mixed,mixed>      $response
     * @param array<string>           $carrierIds
     * @param array<mixed,mixed>|null $request
     *
     * @dataProvider providesTestTrackPackagesLastStatusesByIds
     */
    public function testTrackPackagesLastStatusesByIds(
        int $statusCode,
        array $response,
        Carrier $carrier,
        array $carrierIds,
        StatusCollection|Throwable|null $result,
        ?array $request = null,
    ): void {
        if ($result instanceof Throwable) {
            $this->expectException($result::class);
            $this->expectExceptionMessage($result->getMessage());
        }

        $service = $this->newTrackService($statusCode, $response, $request);

        $res = $service->trackPackagesLastStatusesByIds($carrier, $carrierIds);

        if ($result !== null) {
            self::assertEquals($result, $res);
        }
    }

    /**
     * @return iterable<array<mixed,mixed>>
     */
    public function providesTestTrackPackagesLastStatusesByIds(): iterable
    {
        yield 'response_without_status' => [
            'statusCode' => 200,
            'response'   => [
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
            ],
            'carrier'    => CarrierType::CP,
            'carrierIds' => ['1', '2'],
            'result'     => new StatusCollection(
                CarrierType::CP,
                [
                    new Status(
                        CarrierType::CP,
                        '1',
                        1.2,
                        'Zásilka byla doručena příjemci.',
                        'Zásilka byla doručena příjemci.',
                        'event',
                        null,
                    ),
                    new Status(
                        CarrierType::CP,
                        '2',
                        2.2,
                        'Zásilka je v přepravě.',
                        'Zásilka je v přepravě.',
                        'event',
                        null,
                    ),
                ],
            ),
        ];

        yield 'missing_data_error' => [
            'statusCode' => 200,
            'response'   => [
                'status' => 200,
            ],
            'carrier'    => CarrierType::CP,
            'carrierIds' => ['1', '2'],
            'result'     => new BadRequestException([], 400),
        ];

        yield 'valid_request' => [
            'statusCode' => 200,
            'response'   => [
                'status'   => 200,
                'packages' => [
                    0 => [
                        'carrier_id'  => '1',
                        'status'      => 200,
                        'status_id'   => 1.2,
                        'status_text' => 'Zásilka byla doručena příjemci.',
                    ],
                    1 => [
                        'carrier_id'  => '3',
                        'status'      => 200,
                        'status_id'   => 1.2,
                        'status_text' => 'Zásilka byla doručena příjemci.',
                    ],
                ],
            ],
            'carrier'    => CarrierType::CP,
            'carrierIds' => ['1', '3'],
            'result'     => null,
            'request'    => [
                'https://apiv2.balikobot.cz/v2/cp/trackstatus',
                [
                    'carrier_ids' => [
                        '1',
                        '3',
                    ],
                ],
            ],
        ];

        yield 'package_index_error' => [
            'statusCode' => 200,
            'response'   => [
                'packages' => [
                    0 => [
                        'carrier_id'  => '1',
                        'status'      => 200,
                        'status_id'   => 1.2,
                        'status_text' => 'Zásilka byla doručena příjemci.',
                    ],
                    2 => [
                        'carrier_id'  => '3',
                        'status'      => 200,
                        'status_id'   => 1.2,
                        'status_text' => 'Zásilka byla doručena příjemci.',
                    ],
                ],
            ],
            'carrier'    => CarrierType::CP,
            'carrierIds' => ['3', '4'],
            'result'     => new BadRequestException([], 400),
        ];

        yield 'package_index_missing_error' => [
            'statusCode' => 200,
            'response'   => [
                'status'   => 200,
                'packages' => [
                    0 => [
                        'carrier_id'  => '1',
                        'status'      => 200,
                        'status_id'   => 1.2,
                        'status_text' => 'Zásilka byla doručena příjemci.',
                    ],
                ],
            ],
            'carrier'    => CarrierType::PPL,
            'carrierIds' => ['1', '3'],
            'result'     => new BadRequestException([], 400),
        ];

        yield 'package_status_error' => [
            'statusCode' => 200,
            'response'   => [
                'status'   => 200,
                'packages' => [
                    0 => [
                        'carrier_id'  => '1',
                        'status'      => 200,
                        'status_id'   => 1.2,
                        'status_text' => 'Zásilka byla doručena příjemci.',
                    ],
                    1 => [
                        'carrier_id' => '1234',
                        'status'     => 404,
                    ],
                ],
            ],
            'carrier'    => CarrierType::PPL,
            'carrierIds' => ['1', '3'],
            'result'     => new BadRequestException([], 404),
        ];
    }

    public function testTrackPackagesLastStatusesByIdsProxy(): void
    {
        $service = $this->createPartialMock(DefaultTrackService::class, ['trackPackagesLastStatusesByIds']);

        $expectedStatuses = [
            new StatusCollection(CarrierType::PPL, [
                0 => new Status(CarrierType::PPL, '1234', 1.1, 'name1', 'name1', 'event', null),
            ]),
            new StatusCollection(CarrierType::CP, [
                0 => new Status(CarrierType::CP, '3456', 1.1, 'name1', 'name1', 'event', null),
            ]),
            new StatusCollection(CarrierType::ZASILKOVNA, [
                0 => new Status(CarrierType::ZASILKOVNA, 'Z123', 1.1, 'name1', 'name1', 'event', null),
                1 => new Status(CarrierType::ZASILKOVNA, 'Z234', 2.1, 'name2', 'name2', 'event', null),
            ]),
        ];

        $service->expects(self::exactly(3))->method('trackPackagesLastStatusesByIds')->withConsecutive(
            [CarrierType::PPL, ['1234']],
            [CarrierType::CP, ['3456']],
            [CarrierType::ZASILKOVNA, ['Z123', 'Z234']],
        )->willReturnOnConsecutiveCalls(...$expectedStatuses);

        $actualStatuses = $service->trackPackageLastStatus(new Package(CarrierType::PPL, '1', '0001', '1234'));
        self::assertSame($expectedStatuses[0][0], $actualStatuses);

        $actualStatuses = $service->trackPackageLastStatusById(CarrierType::CP, '3456');
        self::assertSame($expectedStatuses[1][0], $actualStatuses);

        $packages = new PackageCollection();
        $packages->add(new Package(CarrierType::ZASILKOVNA, '1', '0001', 'Z123'));
        $packages->add(new Package(CarrierType::ZASILKOVNA, '2', '0001', 'Z234'));

        $actualStatuses = $service->trackPackagesLastStatuses($packages);
        self::assertSame($expectedStatuses[2], $actualStatuses);
    }

    /**
     * @param array<mixed,mixed>|string $response
     * @param array<mixed,mixed>|null   $request
     */
    private function newTrackService(int $statusCode, array|string $response, ?array $request = null): DefaultTrackService
    {
        $requester     = $this->newRequester($statusCode, $response, $request);
        $validator     = new Validator();
        $client        = new DefaultClient($requester, $validator);
        $statusFactory = new DefaultPackageStatusFactory($validator);

        return new DefaultTrackService($client, $statusFactory);
    }
}
