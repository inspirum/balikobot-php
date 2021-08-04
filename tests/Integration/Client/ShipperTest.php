<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Integration\Client;

use Inspirum\Balikobot\Definitions\Shipper;
use Inspirum\Balikobot\Exceptions\BadRequestException;
use function array_keys;
use function count;
use function sprintf;
use function strtoupper;

class ShipperTest extends AbstractClientTestCase
{
    public function testBranchCountryFilterSupport(): void
    {
        $service = $this->newClient();

        // get all shipper service codes
        $shippers  = Shipper::all();
        $countries = ['CZ', 'EE'];

        foreach ($shippers as $shipper) {
            try {
                $shipperService = (string) array_keys($service->getServices($shipper, null))[0];

                $branches = $service->getBranches($shipper, $shipperService, fullBranchesRequest: false);
                if (count($branches) === 0) {
                    continue;
                }

                $totalCount = 0;
                foreach ($countries as $country) {
                    $branches    = $service->getBranches($shipper, $shipperService, $country, fullBranchesRequest: false);
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
                            $shipperService ?? 'NULL'
                        )
                    );
                } else {
                    $this->assertTrue(
                        $shouldSupport,
                        sprintf(
                            '%s/%s should not support branch country filter',
                            strtoupper($shipper),
                            $shipperService ?? 'NULL'
                        )
                    );
                }
            } catch (BadRequestException $exception) {
                $this->assertFalse(
                    Shipper::hasBranchCountryFilterSupport($shipper, $shipperService),
                    sprintf(
                        '%s/%s: %s',
                        strtoupper($shipper),
                        $shipperService ?? 'NULL',
                        $exception->getMessage()
                    )
                );
            }
        }
    }
}
