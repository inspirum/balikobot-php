<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Balikobot;

use Inspirum\Balikobot\Services\Balikobot;
use function array_keys;

class GetCountriesDataMethodTest extends AbstractBalikobotTestCase
{
    public function testMakeRequest(): void
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status'        => 200,
            'service_types' => [],
        ], [
            'https://apiv2.balikobot.cz/getCountriesData',
            [],
        ]);

        $service = new Balikobot($requester);

        $service->getCountriesData();

        self::assertTrue(true);
    }

    public function testResponseData(): void
    {
        $service = $this->newMockedBalikobot(200, [
            'status'    => 200,
            'countries' => [
                [
                    'name_en'      => 'Andorra',
                    'name_cz'      => 'Andorra',
                    'iso_code'     => 'AD',
                    'phone_prefix' => '+376',
                    'currency'     => 'EUR',
                    'continent'    => 'Europe',
                ],
                [
                    'name_en'      => 'United Arab Emirates',
                    'name_cz'      => 'Spojené arabské emiráty',
                    'iso_code'     => 'AE',
                    'phone_prefix' => '+1-71',
                    'currency'     => 'AED',
                    'continent'    => 'Asia',
                ],
                [
                    'name_en'      => 'Puerto Rico',
                    'name_cz'      => 'Portoriko',
                    'iso_code'     => 'PR',
                    'phone_prefix' => ['+1787', '+1939'],
                    'currency'     => 'USD',
                    'continent'    => 'America',
                ],
            ],
        ]);

        $countries = $service->getCountriesData();

        self::assertCount(3, $countries);
        self::assertEquals('Andorra', $countries['AD']->getName('cs'));
        self::assertEquals('United Arab Emirates', $countries['AE']->getName('en'));
        self::assertEquals(['cs', 'en'], array_keys($countries['AE']->getNames()));
        self::assertEquals('Spojené arabské emiráty', $countries['AE']->getName('cs'));
        self::assertEquals('AD', $countries['AD']->getCode());
        self::assertEquals('+376', $countries['AD']->getPhonePrefix());
        self::assertEquals(['+1787', '+1939'], $countries['PR']->getPhonePrefixes());
        self::assertEquals('+1787', $countries['PR']->getPhonePrefix());
        self::assertEquals('EUR', $countries['AD']->getCurrencyCode());
        self::assertEquals('Europe', $countries['AD']->getContinent());
        self::assertEquals('Asia', $countries['AE']->getContinent());
    }
}
