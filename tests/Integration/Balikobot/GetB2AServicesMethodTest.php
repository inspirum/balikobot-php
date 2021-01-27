<?php

namespace Inspirum\Balikobot\Tests\Integration\Balikobot;

use Inspirum\Balikobot\Definitions\Shipper;

class GetB2AServicesMethodTest extends AbstractBalikobotTestCase
{
    public function testValidRequest()
    {
        $service = $this->newBalikobot();

        $services = $service->getB2AServices(Shipper::PPL);

        $this->assertTrue(count($services) > 0);
        foreach ($services as $id => $unit) {
            $this->assertTrue(is_int($id));
            $this->assertTrue(is_string($unit));
        }
    }
}
