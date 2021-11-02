<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Integration\Balikobot;

use Inspirum\Balikobot\Definitions\Shipper;
use function array_key_exists;
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
            self::assertTrue(array_key_exists('name', $attribute));
            self::assertTrue(array_key_exists('data_type', $attribute));
            self::assertTrue(array_key_exists('max_length', $attribute));
        }
    }
}
