<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Integration\Balikobot;

use Inspirum\Balikobot\Definitions\ServiceType;
use Inspirum\Balikobot\Definitions\Shipper;
use function array_filter;
use function array_keys;
use function array_map;
use function sprintf;

class ShipperTest extends AbstractBalikobotTestCase
{
    public function testPackageSupportAllShippers(): void
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
            'airway',
            'japo',
        ];

        self::assertEqualsCanonicalizing($supportedShippers, $shippers);
    }

    public function testPackageSupportAllShippersServices(): void
    {
        $service = $this->newBalikobot();

        $supportedServices = ServiceType::all();
        $supportedServices = array_map(static fn($data) => array_filter($data), $supportedServices);

        $shippers = Shipper::all();
        foreach ($shippers as $shipper) {
            $services = array_map('strval', array_keys($service->getServices($shipper)));

            self::assertEqualsCanonicalizing(
                $supportedServices[$shipper],
                $services,
                sprintf('Shipper services are not equal for shipper "%s".', $shipper)
            );
        }
    }
}
