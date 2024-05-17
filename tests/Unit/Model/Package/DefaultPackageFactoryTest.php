<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Model\Package;

use Inspirum\Balikobot\Client\Response\Validator;
use Inspirum\Balikobot\Definitions\Carrier;
use Inspirum\Balikobot\Exception\BadRequestException;
use Inspirum\Balikobot\Model\Package\DefaultPackage;
use Inspirum\Balikobot\Model\Package\DefaultPackageCollection;
use Inspirum\Balikobot\Model\Package\DefaultPackageFactory;
use Inspirum\Balikobot\Model\Package\PackageCollection;
use Inspirum\Balikobot\Tests\Unit\BaseTestCase;
use PHPUnit\Framework\Attributes\DataProvider;
use Throwable;

final class DefaultPackageFactoryTest extends BaseTestCase
{
    /**
     * @param array<array<string,mixed>>|null $packages
     * @param array<string,mixed> $data
     */
    #[DataProvider('providesTestCreateCollection')]
    public function testCreateCollection(string $carrier, ?array $packages, array $data, PackageCollection|Throwable $result): void
    {
        if ($result instanceof Throwable) {
            $this->expectException($result::class);
            $this->expectExceptionMessage($result->getMessage());
        }

        $factory = $this->newDefaultPackageFactory();

        $collection = $factory->createCollection($carrier, $packages, $data);

        self::assertEquals($result, $collection);
    }

    /**
     * @return iterable<array<string,mixed>>
     */
    public static function providesTestCreateCollection(): iterable
    {
        yield 'valid' => [
            'carrier' => Carrier::CP,
            'packages' => [
                [
                    'eid' => '0001',
                ],
                [
                    'eid' => '0002',
                ],
            ],
            'data' => [
                'labels_url' => 'https://pdf.balikobot.cz/cp/eNorMTIwt9A1NbYwMwdcMBAZAoC.',
                'packages' => [
                    [
                        'eid' => '0001',
                        'order_number' => 1,
                        'carrier_id' => 'NP1504102246M',
                        'package_id' => '42719',
                        'label_url' => 'https://pdf.balikobot.cz/cp/eNorMTIwt9A1NbYwMwdcMBAZAoA.',
                        'status' => '200',
                    ],
                    [
                        'eid' => '0002',
                        'order_number' => 1,
                        'carrier_id' => 'NP1504102247M',
                        'package_id' => '42720',
                        'label_url' => 'https://pdf.balikobot.cz/cp/eNorMTIwt9A1NbYwMwdcMBAZAoA.',
                        'status' => '200',
                    ],
                ],
            ],
            'result' => new DefaultPackageCollection(
                Carrier::CP,
                [
                    new DefaultPackage(
                        Carrier::CP,
                        '42719',
                        '0001',
                        'NP1504102246M',
                        null,
                        'https://pdf.balikobot.cz/cp/eNorMTIwt9A1NbYwMwdcMBAZAoA.',
                    ),
                    new DefaultPackage(
                        Carrier::CP,
                        '42720',
                        '0002',
                        'NP1504102247M',
                        null,
                        'https://pdf.balikobot.cz/cp/eNorMTIwt9A1NbYwMwdcMBAZAoA.',
                    ),
                ],
                'https://pdf.balikobot.cz/cp/eNorMTIwt9A1NbYwMwdcMBAZAoC.',
            ),
        ];

        yield 'invalid_index' => [
            'carrier' => Carrier::CP,
            'packages' => [
                [
                    'eid' => '8316699909',
                ],
            ],
            'data' => [
                'packages' => [
                    1 => [
                        'eid' => '0001',
                        'order_number' => 1,
                        'carrier_id' => 'NP1504102246M',
                        'package_id' => '42719',
                        'label_url' => 'https://pdf.balikobot.cz/cp/eNorMTIwt9A1NbYwMwdcMBAZAoA.',
                        'status' => 200,
                    ],
                ],
            ],
            'result' => new BadRequestException([], 400),
        ];

        yield 'invalid_count' => [
            'carrier' => Carrier::CP,
            'packages' => [
                [
                    'eid' => '8316699909',
                ],
            ],
            'data' => [
                'packages' => [
                    [
                        'eid' => '0001',
                        'order_number' => 1,
                        'carrier_id' => 'NP1504102246M',
                        'package_id' => '42719',
                        'label_url' => 'https://pdf.balikobot.cz/cp/eNorMTIwt9A1NbYwMwdcMBAZAoA.',
                        'status' => '200',
                    ],
                    [
                        'eid' => '0002',
                        'order_number' => 1,
                        'carrier_id' => 'NP1504102247M',
                        'package_id' => '42720',
                        'label_url' => 'https://pdf.balikobot.cz/cp/eNorMTIwt9A1NbYwMwdcMBAZAoA.',
                        'status' => '200',
                    ],
                ],
            ],
            'result' => new BadRequestException([], 400),
        ];

        yield 'package_status' => [
            'carrier' => Carrier::CP,
            'packages' => [
                [
                    'eid' => '8316699909',
                ],
            ],
            'data' => [
                'packages' => [
                    [
                        'eid' => '0001',
                        'order_number' => 1,
                        'carrier_id' => 'NP1504102246M',
                        'package_id' => '42719',
                        'label_url' => 'https://pdf.balikobot.cz/cp/eNorMTIwt9A1NbYwMwdcMBAZAoA.',
                        'status' => 404,
                    ],
                ],
            ],
            'result' => new BadRequestException([], 404),
        ];

        yield 'b2a' => [
            'carrier' => Carrier::CP,
            'packages' => [
                [
                    'eid' => '0001',
                ],
                [
                    'eid' => '0002',
                ],
            ],
            'data' => [
                'packages' => [
                    [
                        'package_id' => '42718',
                        'status' => '200',
                    ],
                    [
                        'package_id' => '42721',
                        'status' => '200',
                    ],
                ],
                'status' => 200,
            ],
            'result' => new DefaultPackageCollection(
                Carrier::CP,
                [
                    new DefaultPackage(
                        Carrier::CP,
                        '42718',
                        '0001',
                        '',
                    ),
                    new DefaultPackage(
                        Carrier::CP,
                        '42721',
                        '0002',
                        '',
                    ),
                ],
            ),
        ];
    }

    private function newDefaultPackageFactory(): DefaultPackageFactory
    {
        return new DefaultPackageFactory(new Validator());
    }
}
