<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Provider;

use Inspirum\Balikobot\Definitions\Carrier;
use Inspirum\Balikobot\Definitions\Service;
use Inspirum\Balikobot\Provider\DefaultServiceProvider;
use Inspirum\Balikobot\Tests\Unit\BaseTestCase;

final class DefaultServiceProviderTest extends BaseTestCase
{
    public function testGetServices(): void
    {
        $provider = $this->newDefaultServiceProvider();

        foreach (Carrier::getAll() as $carrier) {
            $expectedServices = Service::getForCarrier($carrier);
            $services = $provider->getServices($carrier);

            self::assertSame($expectedServices ?? [], $services);
        }
    }

    private function newDefaultServiceProvider(): DefaultServiceProvider
    {
        return new DefaultServiceProvider();
    }
}
