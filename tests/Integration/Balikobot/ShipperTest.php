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
            'messenger',
            'dhlde',
            'fedex',
            'fofr',
            'dachser',
            'dhlparcel',
            'raben',
            'spring',
            'dsv',
            'dhlfreightec',
            'kurier',
            'dbschenker',
        ];

        $this->assertEqualsCanonicalizing($supportedShippers, $shippers);
    }

    public function testPackageSupportAllShippersServices()
    {
        $service = $this->newBalikobot();

        $supportedServices = ServiceType::all();
        $supportedServices = array_map(function ($data) {
            return array_filter($data);
        }, $supportedServices);

        $shippers = Shipper::all();
        foreach ($shippers as $shipper) {
            $services = array_map('strval', array_keys($service->getServices($shipper)));

            $this->assertEqualsCanonicalizing(
                $supportedServices[$shipper],
                $services,
                sprintf('Shipper services are not equal for shipper "%s".', $shipper)
            );
        }
    }
}
