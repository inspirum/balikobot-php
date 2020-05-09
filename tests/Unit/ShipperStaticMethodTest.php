<?php

namespace Inspirum\Balikobot\Tests\Integration\Balikobot;

use Inspirum\Balikobot\Definitions\Shipper;
use Inspirum\Balikobot\Tests\AbstractTestCase;

class ShipperStaticMethodTest extends AbstractTestCase
{
    public function testFullBranchesSupport()
    {
        $fullbranches = Shipper::hasFullBranchesSupport('cp', 'NP');

        $this->assertTrue($fullbranches);

        $fullbranches = Shipper::hasFullBranchesSupport('zasilkovna', null);

        $this->assertTrue($fullbranches);

        $fullbranches = Shipper::hasFullBranchesSupport('zasilkovna', 'VMCZ');

        $this->assertTrue($fullbranches);

        $fullbranches = Shipper::hasFullBranchesSupport('pbh', '6');

        $this->assertTrue($fullbranches);

        $fullbranches = Shipper::hasFullBranchesSupport('pbh', '15');

        $this->assertTrue($fullbranches);

        $fullbranches = Shipper::hasFullBranchesSupport('cp', 'RR');

        $this->assertFalse($fullbranches);

        $fullbranches = Shipper::hasFullBranchesSupport('ulozenka', null);

        $this->assertFalse($fullbranches);
    }

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

    public function testDHLSupportV2AddRequest()
    {
        $version = Shipper::resolveAddRequestVersion(
            'dhl',
            [
                [
                    'order_number' => 1,
                    'pieces_count' => 3,
                ],
            ]
        );

        $this->assertEquals('v2', $version);
    }

    public function testTNTSupportV2AddRequest()
    {
        $version = Shipper::resolveAddRequestVersion(
            'tnt',
            [
                [
                    'order_number' => 1,
                    'pieces_count' => 3,
                ],
            ]
        );

        $this->assertEquals('v2', $version);
    }

    public function testTopTransSupportV2AddRequest()
    {
        $version = Shipper::resolveAddRequestVersion(
            'toptrans',
            [
                [
                    'order_number' => 1,
                    'pieces_count' => 3,
                ],
            ]
        );

        $this->assertEquals('v2', $version);
    }

    public function testZasilkovnaSupportV2AddRequest()
    {
        $version = Shipper::resolveAddRequestVersion(
            'zasilkovna',
            [
                [
                    'service_type' => 149,
                ],
            ]
        );

        $this->assertEquals('v2', $version);
    }

    public function testUseV1WithoutServiceTypeOption()
    {
        $version = Shipper::resolveAddRequestVersion(
            'zasilkovna',
            [
                [
                    'branch_id' => 149,
                ],
            ]
        );

        $this->assertEquals('v1', $version);
    }

    public function testZasilkovnaSupportV2ServicesRequest()
    {
        $version = Shipper::resolveServicesRequestVersion('zasilkovna');

        $this->assertEquals('v2', $version);
    }

    public function testZasilkovnaSupportV2BranchesRequest()
    {
        $version = Shipper::resolveBranchesRequestVersion('zasilkovna', null);

        $this->assertEquals('v1', $version);
    }

    public function testZasilkovnaWithServiceTypeSupportV2BranchesRequest()
    {
        $version = Shipper::resolveBranchesRequestVersion('zasilkovna', 'VMCZ');

        $this->assertEquals('v2', $version);
    }
}
