<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Integration\Balikobot;

use Inspirum\Balikobot\Definitions\Shipper;
use function count;

class GetActiveShippersMethodTest extends AbstractBalikobotTestCase
{
    public function testValidRequest(): void
    {
        $service = $this->newBalikobot();

        $shippers = $service->getActiveShippers();

        self::assertNotEmpty($shippers);

        $unsupportedShippers = array_diff($shippers, Shipper::all());

        if (count($unsupportedShippers) > 0) {
            self::addWarning(sprintf('Unsupported shippers "%s"', implode(',', $unsupportedShippers)));
        }
    }
}
