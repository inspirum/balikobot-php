<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Integration\Balikobot;

use Inspirum\Balikobot\Contracts\ExceptionInterface;
use Inspirum\Balikobot\Definitions\Shipper;
use Inspirum\Balikobot\Model\Values\AdrUnit;
use function count;
use function is_int;

class GetFullAdrUnitsMethodTest extends AbstractBalikobotTestCase
{
    public function testValidRequest(): void
    {
        $service = $this->newBalikobot();

        $units = $service->getFullAdrUnits(Shipper::TOPTRANS);

        self::assertTrue(count($units) > 0);
        foreach ($units as $code => $unit) {
            self::assertTrue(is_int($code));
            self::assertInstanceOf(AdrUnit::class, $unit);
        }
    }

    public function testInvalidRequest(): void
    {
        $service = $this->newBalikobot();

        try {
            $service->getFullAdrUnits(Shipper::CP);
            self::fail('FULLADRUNITS request should thrown exception');
        } catch (ExceptionInterface $exception) {
            self::assertEquals(404, $exception->getStatusCode());
        }
    }
}
