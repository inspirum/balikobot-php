<?php

namespace Inspirum\Balikobot\Tests\Integration\Balikobot;

use Inspirum\Balikobot\Definitions\Shipper;

class GetServicesMethodTest extends AbstractBalikobotTestCase
{
    public function testValidRequest()
    {
        $service = $this->newBalikobot();

        $services = $service->getServices(Shipper::PPL);

        $this->assertTrue(count($services) > 0);
        foreach ($services as $id => $service) {
            $this->assertTrue(is_int($id));
            $this->assertTrue(is_string($service));
        }
    }
}
