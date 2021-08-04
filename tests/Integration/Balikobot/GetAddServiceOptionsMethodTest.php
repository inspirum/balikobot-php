<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Integration\Balikobot;

use Inspirum\Balikobot\Definitions\ServiceType;
use Inspirum\Balikobot\Definitions\Shipper;
use function count;
use function is_array;
use function is_int;
use function is_string;

class GetAddServiceOptionsMethodTest extends AbstractBalikobotTestCase
{
    public function testValidRequest(): void
    {
        $service = $this->newBalikobot();

        $options = $service->getAddServiceOptions(Shipper::CP);

        $this->assertTrue(count($options) > 0);
        foreach ($options as $serviceType => $serviceOptions) {
            $this->assertTrue(is_string($serviceType));
            foreach ($serviceOptions as $code => $option) {
                $this->assertTrue(is_int($code) || is_string($code));
                $this->assertTrue(is_string($option));
            }
        }
    }

    public function testValidRequestWithService(): void
    {
        $service = $this->newBalikobot();

        $options = $service->getAddServiceOptions(Shipper::CP, ServiceType::CP_CE);

        $this->assertTrue(count($options) > 0);
        foreach ($options as $code => $option) {
            $this->assertTrue(is_int($code));
            $this->assertTrue(is_string($option));
        }
    }

    public function testValidRequestWithFullData(): void
    {
        $service = $this->newBalikobot();

        $options = $service->getAddServiceOptions(Shipper::CP, fullData: true);

        $this->assertTrue(count($options) > 0);
        foreach ($options as $serviceType => $serviceOptions) {
            $this->assertTrue(is_string($serviceType));
            foreach ($serviceOptions as $code => $option) {
                $this->assertTrue(is_array($option));
                $this->assertTrue(is_string($option['name']));
                $this->assertTrue($option['code'] === (string) $code);
            }
        }
    }

    public function testValidRequestWithServiceWithFullData(): void
    {
        $service = $this->newBalikobot();

        $options = $service->getAddServiceOptions(Shipper::CP, ServiceType::CP_CE, fullData: true);

        $this->assertTrue(count($options) > 0);
        foreach ($options as $code => $option) {
            $this->assertTrue(is_array($option));
            $this->assertTrue(is_string($option['name']));
            $this->assertTrue($option['code'] === (string) $code);
        }
    }
}
