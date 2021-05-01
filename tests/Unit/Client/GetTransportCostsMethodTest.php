<?php

namespace Inspirum\Balikobot\Tests\Unit\Client\Request;

use Inspirum\Balikobot\Exceptions\BadRequestException;
use Inspirum\Balikobot\Services\Client;
use Inspirum\Balikobot\Tests\Unit\Client\AbstractClientTestCase;

class GetTransportCostsMethodTest extends AbstractClientTestCase
{
    public function testThrowsExceptionOnError()
    {
        $this->expectException(BadRequestException::class);

        $client = $this->newMockedClient(400, [
            'status' => 200,
        ]);

        $client->getTransportCosts('toptrans', [['eid' => 1]]);
    }

    public function testRequestShouldHaveStatus()
    {
        $this->expectException(BadRequestException::class);

        $client = $this->newMockedClient(200, []);

        $client->getTransportCosts('toptrans', [['eid' => 1]]);
    }

    public function testThrowsExceptionOnBadStatusCode()
    {
        $this->expectException(BadRequestException::class);

        $client = $this->newMockedClient(200, [
            'status'   => 400,
            'packages' => [
                0 => [
                    'eid'             => '8316699909',
                    'costs_total'     => 1200,
                    'currency'        => 'CZK',
                    'costs_breakdown' => [
                        [
                            'name' => 'Base price',
                            'cost' => 1200,
                        ],
                    ],
                ],
            ],
        ]);

        $client->getTransportCosts('toptrans', [['eid' => 1]]);
    }

    public function testThrowsExceptionWhenNoReturnPackages()
    {
        $this->expectException(BadRequestException::class);

        $client = $this->newMockedClient(200, [
            'status'   => 200,
            'packages' => [
                0 => [
                    'status' => 200,
                ],
            ],
        ]);

        $client->getTransportCosts('toptrans', [['eid' => 1]]);
    }

    public function testThrowsExceptionWhenBadResponseData()
    {
        $this->expectException(BadRequestException::class);

        $client = $this->newMockedClient(200, [
            'status'   => 200,
            'packages' => [
                0 => [
                    'eid'    => 1,
                    'status' => 200,
                ],
                1 => [
                    'status' => 200,
                ],
            ],
        ]);

        $client->getTransportCosts('toptrans', [['eid' => 1], ['eid' => 2]]);
    }

    public function testThrowsExceptionWhenWrongNumberOfPackages()
    {
        $this->expectException(BadRequestException::class);

        $client = $this->newMockedClient(200, [
            'status'   => 200,
            'packages' => [
                0 => [
                    'eid'             => '8316699909',
                    'costs_total'     => 1200,
                    'currency'        => 'CZK',
                    'costs_breakdown' => [
                        [
                            'name' => 'Base price',
                            'cost' => 1200,
                        ],
                    ],
                    'status'          => '200',
                ],
                1 => [
                    'eid'             => '9636699909',
                    'costs_total'     => 800,
                    'currency'        => 'CZK',
                    'costs_breakdown' => [
                        [
                            'name' => 'Base price',
                            'cost' => 800,
                        ],
                    ],
                    'status'          => '200',
                ],
            ],
        ]);

        $client->getTransportCosts('toptrans', [['eid' => 1]]);
    }

    public function testMakeRequest()
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status'   => 200,
            'packages' => [
                0 => [
                    'eid'             => '8316699909',
                    'costs_total'     => 1200,
                    'currency'        => 'CZK',
                    'costs_breakdown' => [
                        [
                            'name' => 'Base price',
                            'cost' => 1200,
                        ],
                    ],
                    'status'          => '200',
                ],
            ],
        ]);

        $client = new Client($requester);

        $client->getTransportCosts('toptrans', [['data' => [1, 2, 3], 'test' => false]]);

        $requester->shouldHaveReceived(
            'request',
            [
                'https://apiv2.balikobot.cz/toptrans/transportcosts',
                [
                    [
                        'data' => [1, 2, 3],
                        'test' => false,
                    ],
                ],
            ]
        );

        $this->assertTrue(true);
    }

    public function testOnlyPackagesDataAreReturned()
    {
        $client = $this->newMockedClient(200, [
            'status'   => 200,
            'packages' => [
                0 => [
                    'eid'             => '8316699909',
                    'costs_total'     => 1200,
                    'currency'        => 'CZK',
                    'costs_breakdown' => [
                        [
                            'name' => 'Base price',
                            'cost' => 1200,
                        ],
                    ],
                    'status'          => '200',
                ],
                1 => [
                    'eid'             => '9636699909',
                    'costs_total'     => 800,
                    'currency'        => 'CZK',
                    'costs_breakdown' => [
                        [
                            'name' => 'Base price',
                            'cost' => 800,
                        ],
                    ],
                    'status'          => '200',
                ],
            ],
        ]);

        $packages = $client->getTransportCosts('toptrans', [['eid' => '0001'], ['eid' => '0002']]);

        $this->assertEquals(
            [
                0 => [
                    'eid'             => '8316699909',
                    'costs_total'     => 1200,
                    'currency'        => 'CZK',
                    'costs_breakdown' => [
                        [
                            'name' => 'Base price',
                            'cost' => 1200,
                        ],
                    ],
                    'status'          => '200',
                ],
                1 => [
                    'eid'             => '9636699909',
                    'costs_total'     => 800,
                    'currency'        => 'CZK',
                    'costs_breakdown' => [
                        [
                            'name' => 'Base price',
                            'cost' => 800,
                        ],
                    ],
                    'status'          => '200',
                ],
            ],
            $packages
        );
    }
}
