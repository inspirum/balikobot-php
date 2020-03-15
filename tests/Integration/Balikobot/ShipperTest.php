<?php

namespace Inspirum\Balikobot\Tests\Integration\Balikobot;

use Inspirum\Balikobot\Definitions\ServiceType;
use Inspirum\Balikobot\Definitions\Shipper;

class ShipperTest extends AbstractBalikobotTestCase
{
    public function testPackageSupportAllShippers()
    {
        $service = $this->newBalikobot();

        $shippers = $service->getShippers();

        $supportedShippers = [
            'cp',
            'dhl',
            // 'dhlsk',
            'dpd',
            'geis',
            'gls',
            'intime',
            'pbh',
            'ppl',
            'sp',
            'sps',
            'tnt',
            'toptrans',
            'ulozenka',
            'ups',
            'zasilkovna',
            'gw',
            'gwcz',
        ];

        $this->assertEqualsCanonicalizing($supportedShippers, $shippers);
    }

    public function testPackageSupportAllShippersServices()
    {
        $service = $this->newBalikobot();

        $shippers = Shipper::all();
        $services = [];

        foreach ($shippers as $shipper) {
            $services[$shipper] = array_keys($service->getServices($shipper));
        }

        $supportedServices = ServiceType::all();

        $supportedServices = array_map(function ($data) {
            return array_filter($data);
        }, $supportedServices);

        $this->assertEquals($supportedServices, $services);
    }
}
