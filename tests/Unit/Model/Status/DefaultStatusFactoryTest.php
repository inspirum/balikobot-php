<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Model\Status;

use DateTimeImmutable;
use Inspirum\Balikobot\Client\Response\Validator;
use Inspirum\Balikobot\Exception\BadRequestException;
use Inspirum\Balikobot\Model\Status\DefaultStatus;
use Inspirum\Balikobot\Model\Status\DefaultStatusCollection;
use Inspirum\Balikobot\Model\Status\DefaultStatusFactory;
use Inspirum\Balikobot\Model\Status\DefaultStatuses;
use Inspirum\Balikobot\Model\Status\DefaultStatusesCollection;
use Inspirum\Balikobot\Model\Status\Status;
use Inspirum\Balikobot\Model\Status\StatusCollection;
use Inspirum\Balikobot\Model\Status\StatusesCollection;
use Inspirum\Balikobot\Tests\BaseTestCase;
use Throwable;

final class DefaultStatusFactoryTest extends BaseTestCase
{
    /**
     * @param array<string>       $carrierId
     * @param array<string,mixed> $data
     *
     * @dataProvider providesTestCreateCollection
     */
    public function testCreateCollection(string $carrier, array $carrierId, array $data, StatusesCollection|Throwable $result): void
    {
        if ($result instanceof Throwable) {
            $this->expectException($result::class);
            $this->expectExceptionMessage($result->getMessage());
        }

        $factory = $this->newDefaultStatusFactory();

        $collection = $factory->createCollection($carrier, $carrierId, $data);

        self::assertEquals($result, $collection);
    }

    /**
     * @return iterable<array<string,mixed>>
     */
    public function providesTestCreateCollection(): iterable
    {
        yield 'missing_data_error' => [
            'carrier'    => 'cp',
            'carrierIds' => ['1', '2'],
            'data'       => [
                'status' => 200,
            ],

            'result' => new BadRequestException([], 400),
        ];

        yield 'valid' => [
            'carrier'    => 'cp',
            'carrierIds' => ['3', '4', '5'],
            'data'       => [
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
            'result'     => new DefaultStatusesCollection('cp', [
                new DefaultStatuses('cp', '3', [
                    new DefaultStatus(
                        'cp',
                        '3',
                        2.2,
                        'Zásilka je v přepravě.',
                        'Doručování zásilky',
                        'event',
                        new DateTimeImmutable('2018-11-07 14:15:01'),
                    ),
                    new DefaultStatus(
                        'cp',
                        '3',
                        1.2,
                        'Zásilka byla doručena příjemci.',
                        'Dodání zásilky. (77072 - Depo Olomouc 72)',
                        'event',
                        new DateTimeImmutable('2018-11-08 18:00:00'),
                    ),
                ]),
                new DefaultStatuses('cp', '4', [
                    new DefaultStatus(
                        'cp',
                        '4',
                        2.2,
                        'Zásilka je v přepravě.',
                        'Doručování zásilky',
                        'event',
                        new DateTimeImmutable('2018-11-07 14:15:01'),
                    ),
                ]),
                new DefaultStatuses('cp', '5', [
                    new DefaultStatus(
                        'cp',
                        '5',
                        1.2,
                        'Zásilka byla doručena příjemci.',
                        'Dodání zásilky. (77072 - Depo Olomouc 72)',
                        'event',
                        new DateTimeImmutable('2018-11-08 18:00:00'),
                    ),
                ]),
            ]),
        ];

        yield 'package_index_error' => [
            'carrier'    => 'cp',
            'carrierIds' => ['3', '4', '5'],
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

            'result' => new BadRequestException([], 400),
        ];

        yield 'package_index_missing_error' => [
            'carrier'    => 'ppl',
            'carrierIds' => ['1', '3'],
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

            'result' => new BadRequestException([], 400),
        ];

        yield 'package_status_error' => [
            'carrier'    => 'ppl',
            'carrierIds' => ['1', '3'],
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

            'result' => new BadRequestException([], 503),
        ];

        yield 'package_status_data_error' => [
            'carrier'    => 'cp',
            'carrierIds' => ['1', '2'],
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

            'result' => new BadRequestException([], 400),
        ];
    }

    /**
     * @param array<string>       $carrierId
     * @param array<string,mixed> $data
     *
     * @dataProvider providesTestCreateLastStatusCollection
     */
    public function testCreateLastStatusCollection(string $carrier, array $carrierId, array $data, StatusCollection|Throwable $result): void
    {
        if ($result instanceof Throwable) {
            $this->expectException($result::class);
            $this->expectExceptionMessage($result->getMessage());
        }

        $factory = $this->newDefaultStatusFactory();

        $collection = $factory->createLastStatusCollection($carrier, $carrierId, $data);

        self::assertEquals($result, $collection);
    }

    /**
     * @return iterable<array<mixed,mixed>>
     */
    public function providesTestCreateLastStatusCollection(): iterable
    {
        yield 'valid' => [
            'carrier'    => 'cp',
            'carrierIds' => ['1', '2'],
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
            'result'     => new DefaultStatusCollection(
                'cp',
                [
                    new DefaultStatus(
                        'cp',
                        '1',
                        1.2,
                        'Zásilka byla doručena příjemci.',
                        'Zásilka byla doručena příjemci.',
                        'event',
                        null,
                    ),
                    new DefaultStatus(
                        'cp',
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
            'carrier'    => 'cp',
            'carrierIds' => ['1', '2'],
            'response'   => [
                'status' => 200,
            ],
            'result'     => new BadRequestException([], 400),
        ];

        yield 'package_index_error' => [
            'carrier'    => 'cp',
            'carrierIds' => ['3', '4'],
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
            'result'     => new BadRequestException([], 400),
        ];

        yield 'package_index_missing_error' => [
            'carrier'    => 'ppl',
            'carrierIds' => ['1', '3'],
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
            'result'     => new BadRequestException([], 400),
        ];

        yield 'package_status_error' => [
            'carrier'    => 'ppl',
            'carrierIds' => ['1', '3'],
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
            'result'     => new BadRequestException([], 404),
        ];
    }

    /**
     * @param array<string,mixed> $data
     *
     * @dataProvider providesTestCreate
     */
    public function testCreate(string $carrier, string $carrierId, array $data, Status|Throwable $result): void
    {
        if ($result instanceof Throwable) {
            $this->expectException($result::class);
            $this->expectExceptionMessage($result->getMessage());
        }

        $factory = $this->newDefaultStatusFactory();

        $status = $factory->create($carrier, $carrierId, $data);

        self::assertEquals($result, $status);
    }

    /**
     * @return iterable<array<string,mixed>>
     */
    public function providesTestCreate(): iterable
    {
        yield 'v2' => [
            'carrier' => 'cp',
            'carrierId' => '1',
            'data'   => [
                'date'          => '2018-11-07 14:15:01',
                'name'          => 'Doručení',
                'name_internal' => 'Zásilka byla doručena příjemci.',
                'status_id'     => 2.1,
                'type'          => 'notification',
            ],
            'result' => new DefaultStatus(
                'cp',
                '1',
                2.1,
                'Zásilka byla doručena příjemci.',
                'Doručení',
                'notification',
                new DateTimeImmutable('2018-11-07 14:15:01'),
            ),
        ];

        yield 'missing_data' => [
            'carrier' => 'cp',
            'carrierId' => '2',
            'data'   => [
                'name'      => 'Doručení',
                'status_id' => 2,
            ],
            'result' => new DefaultStatus(
                'cp',
                '2',
                2.0,
                'Doručení',
                'Doručení',
                'event',
                null,
            ),
        ];

        yield 'v3' => [
            'carrier' => 'cp',
            'carrierId' => '3',
            'data'   => [
                'date'           => '2018-11-08 14:18:01',
                'name'           => 'Doručení',
                'name_balikobot' => 'Zásilka byla doručena příjemci.',
                'status_id'      => 2,
                'status_id_v2'   => 2.3,
                'type'           => 'event',
            ],
            'result' => new DefaultStatus(
                'cp',
                '3',
                2.3,
                'Zásilka byla doručena příjemci.',
                'Doručení',
                'event',
                new DateTimeImmutable('2018-11-08 14:18:01'),
            ),
        ];
    }

    /**
     * @param array<string,mixed> $data
     *
     * @dataProvider providesTestCreateLastStatus
     */
    public function testCreateLastStatus(string $carrier, array $data, Status|Throwable $result): void
    {
        if ($result instanceof Throwable) {
            $this->expectException($result::class);
            $this->expectExceptionMessage($result->getMessage());
        }

        $factory = $this->newDefaultStatusFactory();

        $status = $factory->createLastStatus($carrier, $data);

        self::assertEquals($result, $status);
    }

    /**
     * @return iterable<array<string,mixed>>
     */
    public function providesTestCreateLastStatus(): iterable
    {
        yield 'valid' => [
            'carrier' => 'cp',
            'data'   => [
                'carrier_id'  => '1',
                'status'      => 200,
                'status_id'   => 1.2,
                'status_text' => 'Zásilka byla doručena příjemci.',
            ],
            'result' => new DefaultStatus(
                'cp',
                '1',
                1.2,
                'Zásilka byla doručena příjemci.',
                'Zásilka byla doručena příjemci.',
                'event',
                null,
            ),
        ];

        yield 'invalid' => [
            'carrier' => 'cp',
            'data'   => [
                'status' => 200,
            ],
            'result' => new BadRequestException([], 400),
        ];
    }

    private function newDefaultStatusFactory(): DefaultStatusFactory
    {
        return new DefaultStatusFactory(new Validator());
    }
}
