<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Integration\Balikobot;

use Inspirum\Balikobot\Contracts\ExceptionInterface;
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

        self::assertTrue(count($units) > 0);
        foreach ($units as $id => $unit) {
            self::assertTrue(is_int($id));
            self::assertTrue(is_string($unit));
        }
    }

    public function testValidRequestWithFullData(): void
    {
        $service = $this->newBalikobot();

        $units = $service->getAdrUnits(Shipper::TOPTRANS, fullData: true);

        self::assertTrue(count($units) > 0);
        foreach ($units as $id => $unit) {
            self::assertTrue(is_array($unit));
            self::assertTrue(is_array($unit) && is_numeric($unit['id']));
            self::assertTrue(is_array($unit) && is_string($unit['name']));
            self::assertTrue(is_array($unit) && $unit['code'] === (string) $id);
        }
    }

    public function testInvalidRequest(): void
    {
        $service = $this->newBalikobot();

        try {
            $service->getAdrUnits(Shipper::CP);
            self::assertTrue(false, 'ADRUNITS request should thrown exception');
        } catch (ExceptionInterface $exception) {
            self::assertEquals(501, $exception->getStatusCode());
        }
    }
}
