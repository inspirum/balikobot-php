<?php

namespace Inspirum\Balikobot\Tests\Integration\Balikobot;

use Inspirum\Balikobot\Definitions\Shipper;
use Inspirum\Balikobot\Tests\AbstractTestCase;

class ShipperStaticMethodTest extends AbstractTestCase
{
    public function testUseV1WithoutPiecesCountOption()
    {
        $version = Shipper::resolveAddRequestVersion(
            'ups',
            [
                [
                    'eid' => '20191023001',
                ],
            ]
        );

        $this->assertEquals('v1', $version);
    }

    public function testUseV1WithPiecesCountOption()
    {
        $version = Shipper::resolveAddRequestVersion(
            'ups',
            [
                [
                    'eid'          => '20191023001',
                    'pieces_count' => 3,
                ],
            ]
        );

        $this->assertEquals('v1', $version);
    }

    public function testUPSSupportV2AddRequest()
    {
        $version = Shipper::resolveAddRequestVersion(
            'ups',
            [
                [
                    'order_number' => 1,
                    'pieces_count' => 3,
                ],
            ]
        );

        $this->assertEquals('v2', $version);
    }
}
