<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Balikobot;

use Inspirum\Balikobot\Model\Aggregates\PackageCollection;
use Inspirum\Balikobot\Model\Values\Package;
use Inspirum\Balikobot\Services\Balikobot;

class AddPackagesMethodTest extends AbstractBalikobotTestCase
{
    public function testMakeRequest(): void
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status'   => 200,
            'packages' => [
                0 => [
                    'eid'          => '0001',
                    'order_number' => 1,
                    'carrier_id'   => 'NP1504102246M',
                    'package_id'   => '42719',
                    'label_url'    => 'https://pdf.balikobot.cz/cp/eNorMTIwt9A1NbYwMwdcMBAZAoA.',
                    'status'       => '200',
                ],
                1 => [
                    'eid'          => '0001',
                    'order_number' => 1,
                    'carrier_id'   => 'NP1504102247M',
                    'package_id'   => '42720',
                    'label_url'    => 'https://pdf.balikobot.cz/cp/eNorMTIwt9A1NbYwMwdcMBAZAoB.',
                    'status'       => '200',
                ],
            ],
        ]);

        $service = new Balikobot($requester);

        $packages = new PackageCollection('ppl');

        $packages->add(new Package(['vs' => '0001', 'eid' => '0001', 'rec_name' => 'Name']));
        $packages->add(new Package(['vs' => '0002', 'eid' => '0001', 'price' => 2000]));

        $service->addPackages($packages);

        $requester->shouldHaveReceived(
            'request',
            [
                'https://apiv2.balikobot.cz/ppl/add',
                [
                    'packages' => [
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
                ],
            ]
        );

        self::assertTrue(true);
    }

    public function testResponseData(): void
    {
        $service = $this->newMockedBalikobot(200, [
            'status'     => 200,
            'labels_url' => 'https://pdf.balikobot.cz/cp/eNorMTIwt9A1NbYwMwdcMBAZAoC.',
            'packages'   => [
                0 => [
                    'eid'          => '0001',
                    'order_number' => 1,
                    'carrier_id'   => 'NP1504102246M',
                    'package_id'   => '42719',
                    'label_url'    => 'https://pdf.balikobot.cz/cp/eNorMTIwt9A1NbYwMwdcMBAZAoA.',
                    'status'       => '200',
                ],
                1 => [
                    'eid'          => '0002',
                    'order_number' => 1,
                    'carrier_id'   => 'NP1504102247M',
                    'package_id'   => '42720',
                    'label_url'    => 'https://pdf.balikobot.cz/cp/eNorMTIwt9A1NbYwMwdcMBAZAoB.',
                    'status'       => '200',
                ],
            ],
        ]);

        $packages = new PackageCollection('cp');

        $packages->add(new Package(['eid' => '0001']));
        $packages->add(new Package(['eid' => '0002']));

        $orderedPackages = $service->addPackages($packages);

        self::assertEquals(2, $orderedPackages->count());
        self::assertEquals(['42719', '42720'], $orderedPackages->getPackageIds());
        self::assertEquals('NP1504102247M', $orderedPackages[1]->getCarrierId());
        self::assertEquals('0001', $orderedPackages[0]->getBatchId());
        self::assertEquals('0002', $orderedPackages[1]->getBatchId());
        self::assertEquals(
            'https://pdf.balikobot.cz/cp/eNorMTIwt9A1NbYwMwdcMBAZAoC.',
            $orderedPackages->getLabelsUrl()
        );
    }
}
