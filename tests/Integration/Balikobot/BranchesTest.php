<?php

namespace Inspirum\Balikobot\Tests\Integration\Balikobot;

use Inspirum\Balikobot\Definitions\Shipper;
use Inspirum\Balikobot\Exceptions\BadRequestException;

class BranchesTest extends AbstractBalikobotTestCase
{
    public function testBranchesFilterByCountryCode()
    {
        $service  = $this->newBalikobot();
        $shippers = Shipper::all();

        try {
            foreach ($shippers as $shipper) {
                $shipperService = array_keys($service->getServices($shipper))[0] ?? null;
                $branches       = $service->getBranchesForShipperServiceForCountry($shipper, $shipperService, 'DE');
                foreach ($branches as $branch) {
                    $this->assertEquals(
                        'DE',
                        $branch->getCountry(),
                        'Country ' . ($branch->getCountry() ?? '[null]') . ' code should be DE'
                    );

                    break;
                }
            }
        } catch (BadRequestException $exception) {
            $this->assertFalse(true, $exception->getMessage());
        }
    }

    public function testBranchesFilterByCountryCodes()
    {
        $service  = $this->newBalikobot();
        $shippers = Shipper::all();

        try {
            foreach ($shippers as $shipper) {
                $branches = $service->getBranchesForShipperForCountries($shipper, ['DE', 'SK']);
                foreach ($branches as $branch) {
                    $this->assertTrue(
                        in_array($branch->getCountry(), ['SK', 'DE']),
                        'Country ' . ($branch->getCountry() ?? '[null]') . ' code should be DE/SK'
                    );

                    break;
                }
            }
        } catch (BadRequestException $exception) {
            $this->assertFalse(true, $exception->getMessage());
        }
    }
}
