<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Provider;

use Inspirum\Balikobot\Definitions\Carrier;
use Inspirum\Balikobot\Definitions\ServiceType;
use Inspirum\Balikobot\Provider\DefaultServiceProvider;
use Inspirum\Balikobot\Tests\BaseTestCase;

final class DefaultServiceProviderTest extends BaseTestCase
{
    public function testGetServices(): void
    {
        $provider = $this->newDefaultServiceProvider();

        foreach (Carrier::all() as $carrier) {
            $expectedServices = ServiceType::all()[$carrier];
            $services         = $provider->getServices($carrier);

            self::assertSame($expectedServices, $services);
        }
    }

    private function newDefaultServiceProvider(): DefaultServiceProvider
    {
        return new DefaultServiceProvider();
    }
}
