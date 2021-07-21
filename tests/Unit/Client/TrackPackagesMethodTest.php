<?php

namespace Inspirum\Balikobot\Tests\Unit\Client;

use Inspirum\Balikobot\Exceptions\BadRequestException;
use Inspirum\Balikobot\Services\Client;

class TrackPackagesMethodTest extends AbstractClientTestCase
{
    public function testThrowsExceptionOnError()
    {
        $this->expectException(BadRequestException::class);

        $client = $this->newMockedClient(400, [
            'status' => 200,
        ]);

        $client->trackPackage('cp', '1');
    }

    public function testRequestShouldHaveStatus()
    {
        $client = $this->newMockedClient(200, [
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
        ]);

        $status = $client->trackPackage('cp', '1');

        $this->assertNotEmpty($status);
    }

    public function testThrowsExceptionOnBadStatusCode()
    {
        $this->expectException(BadRequestException::class);

        $client = $this->newMockedClient(200, [
            'status' => 400,
        ]);

        $client->trackPackage('cp', '1');
    }

    public function testThrowsExceptionWhenNoDataReturn()
    {
        $this->expectException(BadRequestException::class);

        $client = $this->newMockedClient(200, [
            'status' => 200,
        ]);

        $client->trackPackage('cp', '1');
    }

    public function testMakeRequest()
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status'   => 200,
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
                    ],
                ],
            ],
        ]);

        $client = new Client($requester);

        $client->trackPackage('cp', '1');

        $requester->shouldHaveReceived(
            'request',
            [
                'https://apiv2.balikobot.cz/v2/cp/track',
                [
                    'carrier_ids' => [
                        '1',
                    ],
                ],
            ]
        );

        $this->assertTrue(true);
    }

    public function testDataAreReturnedInV3Format()
    {
        $client = $this->newMockedClient(200, [
            'status'   => 200,
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
                    ],
                ],
            ],
        ]);

        $status = $client->trackPackage('cp', '1');

        $this->assertEquals(
            [
                [
                    'date'          => '2018-11-07 14:15:01',
                    'name'          => 'Doručování zásilky',
                    'status_id'     => 2.2,
                    'type'          => 'event',
                    'name_internal' => 'Zásilka je v přepravě.',
                ],
            ],
            $status
        );
    }

    public function testDataAreReturnedInV3FormatFromV2Response()
    {
        $client = $this->newMockedClient(200, [
            'status'   => 200,
            'packages' => [
                0 => [
                    'carrier_id' => '1',
                    'status'     => 200,
                    'states'     => [
                        [
                            'date'      => '2018-11-07 14:15:01',
                            'name'      => 'Doručování zásilky',
                            'status_id' => 2,
                        ],
                    ],
                ],
            ],
        ]);

        $status = $client->trackPackage('cp', '1');

        $this->assertEquals(
            [
                [
                    'date'          => '2018-11-07 14:15:01',
                    'name'          => 'Doručování zásilky',
                    'status_id'     => 2,
                    'type'          => 'event',
                    'name_internal' => 'Doručování zásilky',
                ],
            ],
            $status
        );
    }

    public function testThrowsExceptionOnErrorWithMultiplePackages()
    {
        $this->expectException(BadRequestException::class);

        $client = $this->newMockedClient(400, [
            'status' => 200,
        ]);

        $client->trackPackages('cp', ['1', '2', '4']);
    }

    public function testRequestShouldNotHaveStatusWithMultiplePackages()
    {
        $client = $this->newMockedClient(200, [
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
        ]);

        $status = $client->trackPackages('cp', ['3', '4', '5']);

        $this->assertNotEmpty($status);
    }

    public function testThrowsExceptionOnBadPackageIndexes()
    {
        $this->expectException(BadRequestException::class);

        $client = $this->newMockedClient(200, [
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
        ]);

        $client->trackPackages('cp', ['3', '4', '5']);
    }

    public function testThrowsExceptionOnBadStatusCodeWithMultiplePackages()
    {
        $this->expectException(BadRequestException::class);

        $client = $this->newMockedClient(200, [
            'status' => 400,
        ]);

        $client->trackPackages('cp', ['4', '2']);
    }

    public function testThrowsExceptionWhenNoDataReturnWithMultiplePackages()
    {
        $this->expectException(BadRequestException::class);

        $client = $this->newMockedClient(200, [
            'status' => 200,
        ]);

        $client->trackPackages('cp', ['1', '3']);
    }

    public function testThrowsExceptionWhenNotAllDataReturnWithMultiplePackages()
    {
        $this->expectException(BadRequestException::class);

        $client = $this->newMockedClient(200, [
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
        ]);

        $client->trackPackages('ppl', ['1', '3']);
    }

    public function testThrowsExceptionWhenBadResponseData()
    {
        $this->expectException(BadRequestException::class);

        $client = $this->newMockedClient(200, [
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
                    'status' => 500,
                ],
            ],
        ]);

        $client->trackPackages('ppl', ['1', '3']);
    }

    public function testMakeRequestWithMultiplePackages()
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
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
                    'carrier_id' => '33',
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
                2 => [
                    'carrier_id' => '4',
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
        ]);

        $client = new Client($requester);

        $client->trackPackages('cp', ['1', '33', '4']);

        $requester->shouldHaveReceived(
            'request',
            [
                'https://apiv2.balikobot.cz/v2/cp/track',
                [
                    'carrier_ids' => [
                        '1',
                        '33',
                        '4',
                    ],
                ],
            ]
        );

        $this->assertTrue(true);
    }

    public function testGlsOnlyReturnsLastPackageStatusesWithMultiplePackages()
    {
        $this->expectException(BadRequestException::class);

        $client = $this->newMockedClient(200, [
            'status'   => 200,
            'packages' => [
                1 => [
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
            ],
        ]);

        $statuses = $client->trackPackages('gls', ['1', '3']);

        $this->assertEquals([], $statuses[0]);
        $this->assertEquals(
            [
                [
                    'date'          => '2018-11-07 14:15:01',
                    'name'          => 'Doručování zásilky',
                    'status_id'     => 2.2,
                    'type'          => 'event',
                    'name_internal' => 'Zásilka je v přepravě.',
                ],
                [
                    'date'          => '2018-11-08 18:00:00',
                    'name'          => 'Dodání zásilky. (77072 - Depo Olomouc 72)',
                    'status_id'     => 1.2,
                    'type'          => 'event',
                    'name_internal' => 'Zásilka byla doručena příjemci.',
                ],
            ],
            $statuses[1]
        );
    }

    public function testDataAreReturnedAsString()
    {
        $client = $this->newMockedClient(200, [
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
        ]);

        $status = $client->trackPackages('cp', ['1', '2']);

        $this->assertEquals(
            [
                0 => [],
                1 => [
                    [
                        'date'          => '2018-11-07 14:15:01',
                        'name'          => 'Doručování zásilky',
                        'status_id'     => 2.2,
                        'type'          => 'event',
                        'name_internal' => 'Zásilka je v přepravě.',
                    ],
                ],
            ],
            $status
        );
    }
}
