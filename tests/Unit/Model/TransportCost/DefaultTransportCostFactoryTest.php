<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Model\TransportCost;

use Inspirum\Balikobot\Client\Response\Validator;
use Inspirum\Balikobot\Definitions\Carrier;
use Inspirum\Balikobot\Exception\BadRequestException;
use Inspirum\Balikobot\Model\TransportCost\DefaultTransportCost;
use Inspirum\Balikobot\Model\TransportCost\DefaultTransportCostCollection;
use Inspirum\Balikobot\Model\TransportCost\DefaultTransportCostFactory;
use Inspirum\Balikobot\Model\TransportCost\DefaultTransportCostPart;
use Inspirum\Balikobot\Model\TransportCost\TransportCostCollection;
use Inspirum\Balikobot\Tests\Unit\BaseTestCase;
use Throwable;

final class DefaultTransportCostFactoryTest extends BaseTestCase
{
    /**
     * @param array<array<string,mixed>>|null $packages
     * @param array<string,mixed>             $data
     *
     * @dataProvider providesTestCreateCollection
     */
    public function testCreateCollection(string $carrier, ?array $packages, array $data, TransportCostCollection|Throwable $result): void
    {
        if ($result instanceof Throwable) {
            $this->expectException($result::class);
            $this->expectExceptionMessage($result->getMessage());
        }

        $factory = $this->newDefaultTransportCostFactory();

        $collection = $factory->createCollection($carrier, $packages, $data);

        self::assertEquals($result, $collection);
    }

    /**
     * @return iterable<array<string,mixed>>
     */
    public function providesTestCreateCollection(): iterable
    {
        yield 'valid' => [
            'carrier' => Carrier::TOPTRANS,
            'packages' => [
                [
                    'eid' => '8316699909',
                ],
                [
                    'eid' => '9636699909',
                ],
            ],
            'data'    => [
                [
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
                [
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
            'result'  =>  new DefaultTransportCostCollection(Carrier::TOPTRANS, [
                new DefaultTransportCost(
                    '8316699909',
                    Carrier::TOPTRANS,
                    1200,
                    'CZK',
                    [
                        new DefaultTransportCostPart(
                            'Base price',
                            1200.0,
                            'CZK',
                        ),
                    ],
                ),
                new DefaultTransportCost(
                    '9636699909',
                    Carrier::TOPTRANS,
                    800,
                    'CZK',
                    [
                        new DefaultTransportCostPart(
                            'Base price',
                            800,
                            'CZK',
                        ),
                    ],
                ),
            ]),
        ];

        yield 'invalid_package_count' => [
            'carrier' => Carrier::TOPTRANS,
            'packages' => [
                [
                    'eid' => '8316699909',
                ],
            ],
            'data'    => [
                [
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
                [
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
            'result'  =>  new BadRequestException([], 400),
        ];

        yield 'missing_package_data' => [
            'carrier' => Carrier::TOPTRANS,
            'packages' => [
                [
                    'eid' => '8316699909',
                ],
                [
                    'eid' => '9636699909',
                ],
            ],
            'data'    => [
                [
                    'eid'             => '8316699909',
                    'costs_total'     => 1200,
                    'currency'        => 'CZK',
                    'costs_breakdown' => [
                        [
                            'name' => 'Base price',
                            'cost' => 1200,
                        ],
                    ],
                    'status'          => '404',
                ],
                [
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
            'result'  =>  new BadRequestException([], 400),
        ];
    }

    private function newDefaultTransportCostFactory(): DefaultTransportCostFactory
    {
        return new DefaultTransportCostFactory(new Validator());
    }
}
