<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Integration\Balikobot;

use Inspirum\Balikobot\Definitions\Shipper;
use function count;
use function is_int;
use function is_string;

class GetServicesMethodTest extends AbstractBalikobotTestCase
{
    public function testValidRequest(): void
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
