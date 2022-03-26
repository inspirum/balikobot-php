<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Integration\Balikobot;

use Inspirum\Balikobot\Definitions\Shipper;
use function count;
use function is_array;
use function is_string;

class GetAddAttributesMethodTest extends AbstractBalikobotTestCase
{
    public function testValidRequest(): void
    {
        $service = $this->newBalikobot();

        $attributes = $service->getAddAttributes(Shipper::CP);

        self::assertTrue(count($attributes) > 0);
        foreach ($attributes as $name => $attribute) {
            self::assertTrue(is_string($name));
            self::assertTrue(is_array($attribute));
            self::assertArrayHasKey('name', $attribute);
            self::assertArrayHasKey('data_type', $attribute);
            self::assertArrayHasKey('max_length', $attribute);
        }
    }
}
