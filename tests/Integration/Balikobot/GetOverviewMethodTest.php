<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Integration\Balikobot;

use Inspirum\Balikobot\Definitions\Shipper;

class GetOverviewMethodTest extends AbstractBalikobotTestCase
{
    public function testValidRequest(): void
    {
        $service = $this->newBalikobot();

        $packages = $service->getOverview(Shipper::ZASILKOVNA);

        self::assertGreaterThanOrEqual(1, $packages->count());
    }
}
