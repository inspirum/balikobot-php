<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Integration;

use Inspirum\Balikobot\Provider\LiveCarrierProvider;

class LiveCarrierProviderTest extends BaseTestCase
{
    public function testGetCarriers(): void
    {
        $provider = new LiveCarrierProvider($this->newDefaultInfoService());

        $expectedCarriers = [
            'cp',
            'dhl',
            'dpd',
            'geis',
            'gls',
            'intime',
            'pbh',
            'ppl',
            'sp',
            'sps',
            'tnt',
            'toptrans',
            'ulozenka',
            'ups',
            'zasilkovna',
            'gw',
            'gwcz',
            'messenger',
            'dhlde',
            'fedex',
            'fofr',
            'dachser',
            'dhlparcel',
            'raben',
            'spring',
            'dsv',
            'dhlfreightec',
            'kurier',
            'dbschenker',
            'airway',
            'japo',
            'liftago',
            'magyarposta',
        ];

        $carriers = $provider->getCarriers();

        self::assertEqualsCanonicalizing($expectedCarriers, $carriers);
    }
}
