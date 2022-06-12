<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Client;

use Inspirum\Balikobot\Exceptions\BadRequestException;
use Inspirum\Balikobot\Services\Client;

class GetTransportCostsMethodTest extends AbstractClientTestCase
{
    public function testThrowsExceptionOnError(): void
    {
        $this->expectException(BadRequestException::class);

        $client = $this->newMockedClient(400, [
            'status' => 200,
        ]);

        $client->getTransportCosts('toptrans', [['eid' => 1]]);
    }

    public function testRequestShouldHaveStatus(): void
    {
        $this->expectException(BadRequestException::class);

        $client = $this->newMockedClient(200, []);

        $client->getTransportCosts('toptrans', [['eid' => 1]]);
    }

    public function testThrowsExceptionOnBadStatusCode(): void
    {
        $this->expectException(BadRequestException::class);

        $client = $this->newMockedClient(200, [
            'status' => 400,
            0        => [
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
        ]);

        $client->getTransportCosts('toptrans', [['eid' => 1]]);
    }

    public function testThrowsExceptionWhenNoReturnPackages(): void
    {
        $this->expectException(BadRequestException::class);

        $client = $this->newMockedClient(200, [
            'status' => 200,
            0        => [
                'status' => 200,
            ],
        ]);

        $client->getTransportCosts('toptrans', [['eid' => 1]]);
    }

    public function testThrowsExceptionWhenBadResponseData(): void
    {
        $this->expectException(BadRequestException::class);

        $client = $this->newMockedClient(200, [
            'status' => 200,
            0        => [
                'eid'    => 1,
                'status' => 200,
            ],
            1        => [
                'status' => 200,
            ],
        ]);

        $client->getTransportCosts('toptrans', [['eid' => 1], ['eid' => 2]]);
    }

    public function testThrowsExceptionWhenWrongNumberOfPackages(): void
    {
        $this->expectException(BadRequestException::class);

        $client = $this->newMockedClient(200, [
            'status' => 200,
            0        => [
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
            1        => [
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
        ]);

        $client->getTransportCosts('toptrans', [['eid' => 1]]);
    }

    public function testMakeRequest(): void
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status' => 200,
            0        => [
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
        ], [
            'https://api.balikobot.cz/toptrans/transportcosts',
            [
                [
                    'data' => [1, 2, 3],
                    'test' => false,
                ],
            ],
        ]);

        $client = new Client($requester);

        $client->getTransportCosts('toptrans', [['data' => [1, 2, 3], 'test' => false]]);

        self::assertTrue(true);
    }

    public function testOnlyPackagesDataAreReturned(): void
    {
        $client = $this->newMockedClient(200, [
            'status' => 200,
            0        => [
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
            1        => [
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
        ]);

        $packages = $client->getTransportCosts('toptrans', [['eid' => '0001'], ['eid' => '0002']]);

        self::assertEquals(
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
