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

        $this->assertTrue(count($attributes) > 0);
        foreach ($attributes as $name => $attribute) {
            $this->assertTrue(is_string($name));
            $this->assertTrue(is_array($attribute));
            $this->assertTrue(array_key_exists('name', $attribute));
            $this->assertTrue(array_key_exists('data_type', $attribute));
            $this->assertTrue(array_key_exists('max_length', $attribute));
        }
    }
}
