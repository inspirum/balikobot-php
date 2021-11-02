<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Balikobot;

use Inspirum\Balikobot\Model\Values\OrderedPackage;
use Inspirum\Balikobot\Services\Balikobot;

class GetPackageInfoMethodTest extends AbstractBalikobotTestCase
{
    public function testMakeRequest(): void
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status' => 200,
        ]);

        $service = new Balikobot($requester);

        $orderedPackage = new OrderedPackage('1', 'ppl', '0001', '1234');

        $service->getPackageInfo($orderedPackage);

        $requester->shouldHaveReceived(
            'request',
            [
                'https://apiv2.balikobot.cz/ppl/package/carrier_id/1234',
                [],
            ]
        );

        self::assertTrue(true);
    }

    public function testResponseData(): void
    {
        $service = $this->newMockedBalikobot(200, [
            'package_id'      => '1',
            'eshop_id'        => 19,
            'carrier_id'      => '1234',
            'track_url'       => '/track',
            'label_url'       => '/labels',
            'carrier_id_swap' => '11111',
            'pieces'          => [1, 3],
            'real_order_id'   => '180001',
            'order_number'    => 2,
            'eid'             => '0002',
        ]);

        $orderedPackage = new OrderedPackage('1', 'ppl', '0001', '1234');

        $package = $service->getPackageInfo($orderedPackage);

        self::assertArrayNotHasKey('package_id', $package->toArray());
        self::assertArrayNotHasKey('eshop_id', $package->toArray());
        self::assertArrayNotHasKey('carrier_id', $package->toArray());
        self::assertArrayNotHasKey('track_url', $package->toArray());
        self::assertArrayNotHasKey('label_url', $package->toArray());
        self::assertArrayNotHasKey('carrier_id_swap', $package->toArray());
        self::assertArrayNotHasKey('pieces', $package->toArray());
        self::assertEquals('0001', $package->getEID());
        self::assertEquals('180001', $package->offsetGet('real_order_id'));
        self::assertEquals(2, $package->offsetGet('order_number'));
        self::assertEquals('0001', $package->offsetGet('eid'));
    }
}
