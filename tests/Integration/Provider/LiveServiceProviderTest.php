<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Integration;

use Inspirum\Balikobot\Definitions\ServiceType;
use Inspirum\Balikobot\Provider\LiveCarrierProvider;
use Inspirum\Balikobot\Provider\LiveServiceProvider;
use function sprintf;

class LiveServiceProviderTest extends BaseTestCase
{
    public function testGetServices(): void
    {
        $carrierProvider = new LiveCarrierProvider($this->newDefaultInfoService());
        $serviceProvider = new LiveServiceProvider($this->newDefaultSettingService());

        foreach ($carrierProvider->getCarriers() as $carrier) {
            $expectedServices = ServiceType::all()[$carrier];
            $services         = $serviceProvider->getServices($carrier);

            self::assertEqualsCanonicalizing(
                $expectedServices,
                $services,
                sprintf('Shipper services are not equal for carrier "%s".', $carrier)
            );
        }
    }
}
