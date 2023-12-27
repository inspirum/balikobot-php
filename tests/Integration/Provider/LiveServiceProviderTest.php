<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Integration;

use Inspirum\Balikobot\Definitions\Service;
use Inspirum\Balikobot\Exception\Exception;
use Inspirum\Balikobot\Provider\LiveCarrierProvider;
use Inspirum\Balikobot\Provider\LiveServiceProvider;
use function sprintf;

final class LiveServiceProviderTest extends BaseTestCase
{
    public function testGetServices(): void
    {
        $carrierProvider = new LiveCarrierProvider($this->newDefaultSettingService());
        $serviceProvider = new LiveServiceProvider($this->newDefaultSettingService());

        foreach ($carrierProvider->getCarriers() as $carrier) {
            $expectedServices = Service::getForCarrier($carrier);

            try {
                $services = $serviceProvider->getServices($carrier);
            } catch (Exception $exception) {
                if ($exception->getStatusCode() === 503) {
                    continue;
                }

                throw  $exception;
            }

            self::assertEqualsCanonicalizing(
                $expectedServices,
                $services,
                sprintf('Carrier services are not equal for carrier "%s".', $carrier),
            );
        }
    }
}
