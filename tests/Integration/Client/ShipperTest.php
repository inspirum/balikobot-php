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
                $shipperServices = array_keys($service->getServices($shipper, null, Shipper::resolveServicesRequestVersion($shipper)));
                $shipperService  = $shipperServices[0] ?? null;
                $service->getBranches($shipper, $shipperService, false, 'CZ');
                $this->assertTrue(
                    Shipper::hasBranchCountryFilterSupport($shipper),
                    sprintf(
                        '%s/%s',
                        strtoupper($shipper),
                        $shipperService !== null ? $shipperService : 'NULL'
                    )
                );
            } catch (BadRequestException $exception) {
                $this->assertFalse(
                    Shipper::hasBranchCountryFilterSupport($shipper),
                    sprintf(
                        '%s/%s: %s',
                        strtoupper($shipper),
                        $shipperService !== null ? $shipperService : 'NULL',
                        $exception->getMessage()
                    )
                );
            }
        }
    }
}
