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
        $shippers  = Shipper::all();
        $countries = ['CZ', 'EE'];

        foreach ($shippers as $shipper) {
            try {
                $shipperServices = array_keys(
                    $service->getServices($shipper, null)
                );
                $shipperService  = $shipperServices[0] ?? null;

                $branches = $service->getBranches($shipper, $shipperService, false);
                if (count($branches) === 0) {
                    continue;
                }

                $totalCount = 0;
                foreach ($countries as $country) {
                    $branches   = $service->getBranches($shipper, $shipperService, false, $country);
                    $totalCount += count($branches);
                    foreach ($branches ?? [] as $branch) {
                        if ($branch['country'] !== $country) {
                            throw new BadRequestException([]);
                        }
                    }
                }

                $shouldSupport = Shipper::hasBranchCountryFilterSupport($shipper, $shipperService);
                if ($shouldSupport === false && $totalCount === 0) {
                    $this->addWarning(
                        sprintf(
                            '%s/%s could support branch country filter',
                            strtoupper($shipper),
                            $shipperService !== null ? $shipperService : 'NULL'
                        )
                    );
                } else {
                    $this->assertTrue(
                        $shouldSupport,
                        sprintf(
                            '%s/%s should not support branch country filter',
                            strtoupper($shipper),
                            $shipperService !== null ? $shipperService : 'NULL'
                        )
                    );
                }
            } catch (BadRequestException $exception) {
                $this->assertFalse(
                    Shipper::hasBranchCountryFilterSupport($shipper, $shipperService),
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
