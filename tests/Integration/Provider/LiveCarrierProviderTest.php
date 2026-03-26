<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Integration\Provider;

use Inspirum\Balikobot\Definitions\Carrier;
use Inspirum\Balikobot\Provider\LiveCarrierProvider;
use Inspirum\Balikobot\Tests\Integration\BaseTestCase;

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
