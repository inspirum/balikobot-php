<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Integration;

use Inspirum\Balikobot\Definitions\Carrier;
use Inspirum\Balikobot\Provider\LiveCarrierProvider;

final class LiveCarrierProviderTest extends BaseTestCase
{
    public function testGetCarriers(): void
    {
        $provider = new LiveCarrierProvider($this->newDefaultSettingService());

        $expectedCarriers = Carrier::getAll();

        $carriers = $provider->getCarriers();

        self::assertEqualsCanonicalizing($expectedCarriers, $carriers);
    }
}
