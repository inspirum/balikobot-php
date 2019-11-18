<?php

namespace Inspirum\Balikobot\Tests\Integration\Client;

use Inspirum\Balikobot\Definitions\Shipper;
use Inspirum\Balikobot\Exceptions\BadRequestException;

class ShipperTest extends AbstractClientTestCase
{
    public function testBranchCountryFilterSupport()
    {
        $service = $this->newClient();

        // get all shipper service codes
        $shippers = Shipper::all();

        foreach ($shippers as $shipper) {
            try {
                $shipperServices = array_keys($service->getServices($shipper));
                $service->getBranches($shipper, $shipperServices[0] ?? null, false, 'CZ');
                $this->assertTrue(Shipper::hasBranchCountryFilterSupport($shipper), strtoupper($shipper));
            } catch (BadRequestException $exception) {
                $this->assertFalse(
                    Shipper::hasBranchCountryFilterSupport($shipper),
                    strtoupper($shipper) . ' ' . $exception->getMessage()
                );
            }
        }
    }
}
