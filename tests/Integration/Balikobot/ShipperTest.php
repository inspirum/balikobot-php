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
            'dpd',
            'ppl',
            'zasilkovna',
            'geis',
            'ulozenka',
            'intime',
            'gls',
            'toptrans',
            'pbh',
            'sp',
            'sps',
            'ups',
            'tnt',
            'dhl',
            'dhlsk',
            'gw',
        ];

        sort($shippers);
        sort($supportedShippers);

        $this->assertEquals($supportedShippers, $shippers);
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

        // make `[null]` array to empty array
        $supportedServices = array_map(function ($data) {
            if (empty(array_filter($data))) {
                return [];
            }

            return $data;
        }, $supportedServices);

        $this->assertEquals($services, $supportedServices);
    }
}
