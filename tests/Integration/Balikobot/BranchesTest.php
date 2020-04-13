<?php

namespace Inspirum\Balikobot\Tests\Integration\Balikobot;

use Inspirum\Balikobot\Definitions\Shipper;
use Inspirum\Balikobot\Exceptions\BadRequestException;

class BranchesTest extends AbstractBalikobotTestCase
{
    public function testBranchesFilterByCountryCodes()
    {
        $service  = $this->newBalikobot();
        $shippers = Shipper::all();

        foreach ($shippers as $shipper) {
            try {
                $branches = $service->getBranchesForShipperForCountries($shipper, ['DE', 'SK']);
                foreach ($branches as $branch) {
                    $this->assertTrue(
                        in_array($branch->getCountry(), ['SK', 'DE']),
                        sprintf('Country %s code should be DE/SK', $branch->getCountry() ?? '[null]')
                    );

                    break;
                }
            } catch (BadRequestException $exception) {
                $errorMessage = $exception->getResponse()['status_message'] ?? '';
                if (strpos($errorMessage, 'Neznámý kód služby') === false) {
                    $this->fail($exception->getMessage());
                }
            }
        }
    }
}
