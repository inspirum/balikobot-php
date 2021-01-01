<?php

namespace Inspirum\Balikobot\Tests\Unit\Client;

use Inspirum\Balikobot\Exceptions\BadRequestException;
use Inspirum\Balikobot\Services\Client;
use Inspirum\Balikobot\Tests\Unit\Client\AbstractClientTestCase;

class CodCountriesRequestTest extends AbstractClientTestCase
{
    public function testThrowsExceptionOnError()
    {
        $this->expectException(BadRequestException::class);

        $requester = $this->newRequesterWithMockedRequestMethod(400, [
            'status' => 200,
        ]);

        $client = new Client($requester);

        $client->getCodCountries('cp');
    }

    public function testRequestShouldHaveStatus()
    {
        $this->expectException(BadRequestException::class);

        $requester = $this->newRequesterWithMockedRequestMethod(200, []);

        $client = new Client($requester);

        $client->getCodCountries('cp');
    }

    public function testThrowsExceptionOnBadStatusCode()
    {
        $this->expectException(BadRequestException::class);

        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status' => 400,
        ]);

        $client = new Client($requester);

        $client->getCodCountries('cp');
    }

    public function testMakeRequest()
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status'        => 200,
            'service_types' => [],
        ]);

        $client = new Client($requester);

        $client->getCodCountries('cp');

        $requester->shouldHaveReceived(
            'request',
            ['https://apiv2.balikobot.cz/cp/cod4services', []]
        );

        $this->assertTrue(true);
    }

    public function testEmptyArrayIsReturnedIfUnitsMissing()
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status'        => 200,
            'service_types' => null,
        ]);

        $client = new Client($requester);

        $countries = $client->getCodCountries('cp');

        $this->assertEquals([], $countries);
    }

    public function testOnlyCountriesDataAreReturned()
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status'        => 200,
            'service_types' => [
                [
                    'service_type'  => 'DR',
                    'cod_countries' => [
                        'CZ' => [
                            'max_price' => 10000,
                            'currency'  => 'CZK',
                        ],
                    ],
                ],
                [
                    'service_type'  => 'VZP',
                    'cod_countries' => [
                        'UA' => [
                            'max_price' => 36000,
                            'currency'  => 'UAH',
                        ],
                        'LV' => [
                            'max_price' => 2000,
                            'currency'  => 'USD',
                        ],
                        'HU' => [
                            'max_price' => 2500,
                            'currency'  => 'EUR',
                        ],
                        'SK' => [
                            'max_price' => 500000,
                            'currency'  => 'CZK',
                        ],
                    ],
                ],
            ],
        ]);

        $client = new Client($requester);

        $countries = $client->getCodCountries('cp');

        $this->assertEquals(
            [
                'DR'  => [
                    'CZ' => [
                        'max_price' => 10000,
                        'currency'  => 'CZK',
                    ],
                ],
                'VZP' => [
                    'UA' => [
                        'max_price' => 36000,
                        'currency'  => 'UAH',
                    ],
                    'LV' => [
                        'max_price' => 2000,
                        'currency'  => 'USD',
                    ],
                    'HU' => [
                        'max_price' => 2500,
                        'currency'  => 'EUR',
                    ],
                    'SK' => [
                        'max_price' => 500000,
                        'currency'  => 'CZK',
                    ],
                ],
            ],
            $countries
        );
    }
}
