<?php

namespace Inspirum\Balikobot\Tests\Integration\Balikobot;

use Inspirum\Balikobot\Definitions\Shipper;

class GetOverviewMethodTest extends AbstractBalikobotTestCase
{
    public function testValidRequest()
    {
        $service = $this->newBalikobot();

        $packages = $service->getOverview(Shipper::ZASILKOVNA);

        $this->assertGreaterThanOrEqual(1, $packages->count());
    }
}
