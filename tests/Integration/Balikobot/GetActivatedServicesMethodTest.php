<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Integration\Balikobot;

use Inspirum\Balikobot\Definitions\Shipper;
use function count;
use function is_bool;

class GetActivatedServicesMethodTest extends AbstractBalikobotTestCase
{
    public function testValidRequest(): void
    {
        $service = $this->newBalikobot();

        $services = $service->getActivatedServices(Shipper::PPL);

        $this->assertTrue(isset($services['active_parcel']) === false || is_bool($services['active_parcel']));
        $this->assertTrue(isset($services['active_cargo']) === false || is_bool($services['active_cargo']));
        $this->assertTrue(count($services['service_types']) > 0);
    }
}
