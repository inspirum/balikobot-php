<?php

namespace Inspirum\Balikobot\Tests\Unit\Balikobot;

use Inspirum\Balikobot\Services\Balikobot;

class GetCountriesDataMethodTest extends AbstractBalikobotTestCase
{
    public function testMakeRequest()
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status'        => 200,
            'service_types' => [],
        ]);

        $service = new Balikobot($requester);

        $service->getCountriesData();

        $requester->shouldHaveReceived(
            'request',
            [
                'https://apiv2.balikobot.cz/getCountriesData',
                [],
            ]
        );

        $this->assertTrue(true);
    }

    public function testResponseData()
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

        $this->assertCount(3, $countries);
        $this->assertEquals('Andorra', $countries['AD']->getName('cs'));
        $this->assertEquals('United Arab Emirates', $countries['AE']->getName('en'));
        $this->assertEquals(['cs', 'en'], array_keys($countries['AE']->getNames()));
        $this->assertEquals('Spojené arabské emiráty', $countries['AE']->getName('cs'));
        $this->assertEquals('AD', $countries['AD']->getCode());
        $this->assertEquals('+376', $countries['AD']->getPhonePrefix());
        $this->assertEquals(['+1787', '+1939'], $countries['PR']->getPhonePrefixes());
        $this->assertEquals('+1787', $countries['PR']->getPhonePrefix());
        $this->assertEquals('EUR', $countries['AD']->getCurrencyCode());
        $this->assertEquals('Europe', $countries['AD']->getContinent());
        $this->assertEquals('Asia', $countries['AE']->getContinent());
    }
}
