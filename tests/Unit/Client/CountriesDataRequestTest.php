<?php

namespace Inspirum\Balikobot\Tests\Unit\Client;

use Inspirum\Balikobot\Exceptions\BadRequestException;
use Inspirum\Balikobot\Services\Client;
use Inspirum\Balikobot\Tests\Unit\Client\AbstractClientTestCase;

class CountriesDataRequestTest extends AbstractClientTestCase
{
    public function testThrowsExceptionOnError()
    {
        $this->expectException(BadRequestException::class);

        $requester = $this->newRequesterWithMockedRequestMethod(400, [
            'status' => 200,
        ]);

        $client = new Client($requester);

        $client->getCountriesData();
    }

    public function testRequestShouldHaveStatus()
    {
        $this->expectException(BadRequestException::class);

        $requester = $this->newRequesterWithMockedRequestMethod(200, []);

        $client = new Client($requester);

        $client->getCountriesData();
    }

    public function testThrowsExceptionOnBadStatusCode()
    {
        $this->expectException(BadRequestException::class);

        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status' => 400,
        ]);

        $client = new Client($requester);

        $client->getCountriesData();
    }

    public function testMakeRequest()
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status'        => 200,
            'service_types' => [],
        ]);

        $client = new Client($requester);

        $client->getCountriesData();

        $requester->shouldHaveReceived(
            'request',
            ['https://api.balikobot.cz/getCountriesData', []]
        );

        $this->assertTrue(true);
    }

    public function testEmptyArrayIsReturnedIfUnitsMissing()
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status'    => 200,
            'countries' => null,
        ]);

        $client = new Client($requester);

        $countries = $client->getCountriesData();

        $this->assertEquals([], $countries);
    }

    public function testOnlyCountriesDataAreReturned()
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

        $client = new Client($requester);

        $countries = $client->getCountriesData();

        $this->assertEquals(
            [
                'AD' => [
                    'name_en'      => 'Andorra',
                    'name_cz'      => 'Andorra',
                    'iso_code'     => 'AD',
                    'phone_prefix' => '+376',
                    'currency'     => 'EUR',
                    'continent'    => 'Europe',
                ],
                'AE' => [
                    'name_en'      => 'United Arab Emirates',
                    'name_cz'      => 'Spojené arabské emiráty',
                    'iso_code'     => 'AE',
                    'phone_prefix' => '+971',
                    'currency'     => 'AED',
                    'continent'    => 'Asia',
                ],
            ],
            $countries
        );
    }
}
