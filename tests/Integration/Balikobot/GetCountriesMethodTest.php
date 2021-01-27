<?php

namespace Inspirum\Balikobot\Tests\Integration\Balikobot;

use Inspirum\Balikobot\Definitions\Shipper;

class GetCountriesMethodTest extends AbstractBalikobotTestCase
{
    public function testValidRequest()
    {
        $service = $this->newBalikobot();

        $countries = $service->getCountries(Shipper::CP);

        $this->assertTrue(count($countries) > 0);
    }
}
