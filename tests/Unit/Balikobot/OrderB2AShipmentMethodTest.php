<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Balikobot;

use Inspirum\Balikobot\Model\Aggregates\PackageCollection;
use Inspirum\Balikobot\Model\Values\Package;
use Inspirum\Balikobot\Services\Balikobot;

class OrderB2AShipmentMethodTest extends AbstractBalikobotTestCase
{
    public function testMakeRequest(): void
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status' => 200,
            0        => [
                'carrier_id'     => 'NP1504102246M',
                'package_id'     => '21',
                'track_url'      => 'https://www.geis-group.cz/cs/sledovani-zasilky/?p=NP1504102246M',
                'status_message' => 'OK, přeprava byla objednána.',
                'status'         => '200',
            ],
            1        => [
                'carrier_id'     => 'NP1504102247M',
                'package_id'     => '22',
                'track_url'      => 'https://www.geis-group.cz/cs/sledovani-zasilky/?p=NP1504102247M',
                'status_message' => 'OK, přeprava byla objednána.',
                'status'         => '200',
            ],
        ], [
            'https://api.balikobot.cz/geis/b2a',
            [
                0 => [
                    'eid'         => '0001',
                    'mu_type'     => 'EP',
                    'pickup_date' => '2019-07-12',
                ],
                1 => [
                    'eid'         => '0001',
                    'mu_type'     => 'UV',
                    'pickup_date' => '2019-07-12',
                ],
            ],
        ]);

        $service = new Balikobot($requester);

        $packages = new PackageCollection('geis');

        $packages->add(new Package(['eid' => '0001', 'mu_type' => 'EP', 'pickup_date' => '2019-07-12']));
        $packages->add(new Package(['eid' => '0001', 'mu_type' => 'UV', 'pickup_date' => '2019-07-12']));

        $service->orderB2AShipment($packages);

        self::assertTrue(true);
    }

    public function testResponseData(): void
    {
        $service = $this->newMockedBalikobot(200, [
            'status' => 200,
            0        => [
                'carrier_id'     => 'NP1504102246M',
                'package_id'     => '21',
                'track_url'      => 'https://www.geis-group.cz/cs/sledovani-zasilky/?p=NP1504102246M',
                'status_message' => 'OK, přeprava byla objednána.',
                'status'         => '200',
            ],
            1        => [
                'carrier_id'     => 'NP1504102247M',
                'package_id'     => '22',
                'track_url'      => 'https://www.geis-group.cz/cs/sledovani-zasilky/?p=NP1504102247M',
                'status_message' => 'OK, přeprava byla objednána.',
                'status'         => '200',
            ],
        ]);

        $packages = new PackageCollection('geis');

        $packages->add(new Package(['eid' => '0001']));
        $packages->add(new Package(['eid' => '0002']));

        $orderedPackages = $service->orderB2AShipment($packages);

        self::assertEquals(2, $orderedPackages->count());
        self::assertEquals(['21', '22'], $orderedPackages->getPackageIds());
        self::assertEquals('NP1504102247M', $orderedPackages[1]->getCarrierId());
        self::assertEquals('0001', $orderedPackages[0]->getBatchId());
        self::assertEquals('0002', $orderedPackages[1]->getBatchId());
    }

    public function testResponseDataWithoutCarrierId(): void
    {
        $service = $this->newMockedBalikobot(200, [
            'status' => 200,
            0        => [
                'package_id'     => '21',
                'status_message' => 'OK, přeprava byla objednána.',
                'status'         => '200',
            ],
            1        => [
                'package_id'     => '22',
                'status_message' => 'OK, přeprava byla objednána.',
                'status'         => '200',
            ],
        ]);

        $packages = new PackageCollection('ppl');

        $packages->add(new Package(['eid' => '0001']));
        $packages->add(new Package(['eid' => '0002']));

        $orderedPackages = $service->orderB2AShipment($packages);

        self::assertEquals(2, $orderedPackages->count());
        self::assertEquals(['21', '22'], $orderedPackages->getPackageIds());
        self::assertEquals('0001', $orderedPackages[0]->getBatchId());
        self::assertEquals('0002', $orderedPackages[1]->getBatchId());
    }
}
