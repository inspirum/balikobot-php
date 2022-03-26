<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Integration\Balikobot;

use Inspirum\Balikobot\Definitions\Shipper;
use Inspirum\Balikobot\Exceptions\BadRequestException;
use function in_array;
use function sprintf;
use function strpos;

class BranchesTest extends AbstractBalikobotTestCase
{
    public function testBranchesFilterByCountryCodes(): void
    {
        $service  = $this->newBalikobot();
        $shippers = Shipper::all();

        foreach ($shippers as $shipper) {
            try {
                $branches = $service->getBranchesForShipperForCountries($shipper, ['DE', 'SK']);
                foreach ($branches as $branch) {
                    self::assertNotEmpty($branch->getId());
                    self::assertNotEmpty($branch->getBranchId());
                    self::assertTrue(
                        in_array($branch->getCountry(), ['SK', 'DE']),
                        sprintf('Country %s code should be DE/SK', $branch->getCountry() ?? '[null]')
                    );

                    break;
                }
            } catch (BadRequestException $exception) {
                if ($exception->getStatusCode() === 501) {
                    continue;
                }

                $errorMessage = $exception->getResponse()['status_message'] ?? '';
                if (strpos($errorMessage, 'Neznámý kód služby') === false) {
                    $this->fail(sprintf('%s: %s', $shipper, $exception->getMessage()));
                }
            }
        }
    }
}
