<?php

namespace Inspirum\Balikobot\Tests\Unit\Balikobot;

use Inspirum\Balikobot\Model\Values\OrderedPackage;
use Inspirum\Balikobot\Services\Balikobot;

class GetPackageInfoTest extends AbstractBalikobotTestCase
{
    public function testMakeRequest()
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
                'https://api.balikobot.cz/ppl/package/1',
                [],
            ]
        );

        $this->assertTrue(true);
    }

    public function testResponseData()
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
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

        $service = new Balikobot($requester);

        $orderedPackage = new OrderedPackage('1', 'ppl', '0001', '1234');

        $package = $service->getPackageInfo($orderedPackage);

        $this->assertArrayNotHasKey('package_id', $package->toArray());
        $this->assertArrayNotHasKey('eshop_id', $package->toArray());
        $this->assertArrayNotHasKey('carrier_id', $package->toArray());
        $this->assertArrayNotHasKey('track_url', $package->toArray());
        $this->assertArrayNotHasKey('label_url', $package->toArray());
        $this->assertArrayNotHasKey('carrier_id_swap', $package->toArray());
        $this->assertArrayNotHasKey('pieces', $package->toArray());
        $this->assertEquals('0001', $package->getEID());
        $this->assertEquals('180001', $package->offsetGet('real_order_id'));
        $this->assertEquals(2, $package->offsetGet('order_number'));
        $this->assertEquals('0001', $package->offsetGet('eid'));
    }
}
