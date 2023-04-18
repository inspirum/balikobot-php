<?php

namespace Inspirum\Balikobot\Tests\Integration\Balikobot;

use Inspirum\Balikobot\Definitions\Shipper;
use Inspirum\Balikobot\Exceptions\BadRequestException;

class GetAdrUnitsMethodTest extends AbstractBalikobotTestCase
{
    public function testValidRequest()
    {
        $service = $this->newBalikobot();

        $units = $service->getAdrUnits(Shipper::TOPTRANS);

        $this->assertTrue(count($units) > 0);
        foreach ($units as $id => $unit) {
            $this->assertTrue(is_int($id));
            $this->assertTrue(is_string($unit));
        }
    }

    public function testValidRequestWithFullData()
    {
        $service = $this->newBalikobot();

        $units = $service->getAdrUnits(Shipper::TOPTRANS, true);

        $this->assertTrue(count($units) > 0);
        foreach ($units as $id => $unit) {
            $this->assertTrue(is_array($unit));
            $this->assertTrue(is_numeric($unit['id']));
            $this->assertTrue(is_string($unit['name']));
            $this->assertTrue($unit['code'] == $id);
        }
    }

    public function testInvalidRequest()
    {
        $this->expectException(BadRequestException::class);

        $service = $this->newBalikobot();

        $service->getAdrUnits(Shipper::CP);
    }
}
