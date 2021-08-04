<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Integration\Balikobot;

use Inspirum\Balikobot\Definitions\Shipper;
use function count;
use function is_array;
use function is_int;
use function is_numeric;
use function is_string;

class GetAdrUnitsMethodTest extends AbstractBalikobotTestCase
{
    public function testValidRequest(): void
    {
        $service = $this->newBalikobot();

        $units = $service->getAdrUnits(Shipper::TOPTRANS);

        $this->assertTrue(count($units) > 0);
        foreach ($units as $id => $unit) {
            $this->assertTrue(is_int($id));
            $this->assertTrue(is_string($unit));
        }
    }

    public function testValidRequestWithFullData(): void
    {
        $service = $this->newBalikobot();

        $units = $service->getAdrUnits(Shipper::TOPTRANS, fullData: true);

        $this->assertTrue(count($units) > 0);
        foreach ($units as $id => $unit) {
            $this->assertTrue(is_array($unit));
            $this->assertTrue(is_numeric($unit['id']));
            $this->assertTrue(is_string($unit['name']));
            $this->assertTrue($unit['code'] === (string) $id);
        }
    }

    public function testInvalidRequest(): void
    {
        $service = $this->newBalikobot();

        $units = $service->getAdrUnits(Shipper::CP);

        $this->assertTrue(count($units) === 0);
    }
}
