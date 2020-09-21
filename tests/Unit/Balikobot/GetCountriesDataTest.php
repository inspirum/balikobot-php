<?php

namespace Inspirum\Balikobot\Tests\Unit\Balikobot;

use Inspirum\Balikobot\Services\Balikobot;

class GetCountriesDataTest extends AbstractBalikobotTestCase
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
                'https://api.balikobot.cz/getCountriesData',
                [],
            ]
        );

        $this->assertTrue(true);
    }

    public function testResponseData()
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
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
                    'phone_prefix' => '+971',
                    'currency'     => 'AED',
                    'continent'    => 'Asia',
                ],
            ],
        ]);

        $service = new Balikobot($requester);

        $countries = $service->getCountriesData();

        $this->assertCount(2, $countries);
        $this->assertEquals('Andorra', $countries['AD']->getName('cs'));
        $this->assertEquals('United Arab Emirates', $countries['AE']->getName('en'));
        $this->assertEquals('Spojené arabské emiráty', $countries['AE']->getName('cs'));
        $this->assertEquals('AD', $countries['AD']->getCode());
        $this->assertEquals('+376', $countries['AD']->getPhonePrefix());
        $this->assertEquals('EUR', $countries['AD']->getCurrencyCode());
        $this->assertEquals('Europe', $countries['AD']->getContinent());
        $this->assertEquals('Asia', $countries['AE']->getContinent());
    }
}
