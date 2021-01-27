<?php

namespace Inspirum\Balikobot\Tests\Integration\Balikobot;

use Inspirum\Balikobot\Definitions\Shipper;

class GetCodCountriesMethodTest extends AbstractBalikobotTestCase
{
    public function testValidRequest()
    {
        $service = $this->newBalikobot();

        $countries = $service->getCodCountries(Shipper::CP);

        $this->assertTrue(count($countries) > 0);
    }
}
