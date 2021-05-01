<?php

namespace Inspirum\Balikobot\Tests\Unit\Balikobot;

use Inspirum\Balikobot\Model\Aggregates\PackageCollection;
use Inspirum\Balikobot\Model\Values\Package;
use Inspirum\Balikobot\Services\Balikobot;

class GetTransportCostsMethodTest extends AbstractBalikobotTestCase
{
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

        $service = new Balikobot($requester);

        $packages = new PackageCollection('toptrans');

        $packages->add(new Package(['vs' => '0001', 'eid' => '0001', 'rec_name' => 'Name']));
        $packages->add(new Package(['vs' => '0002', 'eid' => '0001', 'price' => 2000]));

        $service->getTransportCosts($packages);

        $requester->shouldHaveReceived(
            'request',
            [
                'https://apiv2.balikobot.cz/toptrans/transportcosts',
                [
                    0 => [
                        'eid'      => '0001',
                        'vs'       => '0001',
                        'rec_name' => 'Name',
                    ],
                    1 => [
                        'eid'   => '0001',
                        'vs'    => '0002',
                        'price' => 2000,
                    ],
                ],
            ]
        );

        $this->assertTrue(true);
    }

    public function testResponseData()
    {
        $service = $this->newMockedBalikobot(200, [
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

        $packages = new PackageCollection('cp');

        $packages->add(new Package(['eid' => '0001']));
        $packages->add(new Package(['eid' => '0002']));

        $transportCosts = $service->getTransportCosts($packages);

        $this->assertEquals(2, $transportCosts->count());
        $this->assertEquals(['8316699909', '9636699909'], $transportCosts->getBatchIds());
        $this->assertEquals('8316699909', $transportCosts[0]->getBatchId());
        $this->assertEquals(1200, $transportCosts[0]->getTotalCost());
        $this->assertEquals('9636699909', $transportCosts[1]->getBatchId());
        $this->assertEquals(800, $transportCosts[1]->getTotalCost());
        $this->assertEquals(2000, $transportCosts->getTotalCost());
    }
}
