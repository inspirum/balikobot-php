<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Client;

use Inspirum\Balikobot\Exceptions\BadRequestException;
use Inspirum\Balikobot\Services\Client;

class GetCodCountriesMethodTest extends AbstractClientTestCase
{
    public function testThrowsExceptionOnError(): void
    {
        $this->expectException(BadRequestException::class);

        $client = $this->newMockedClient(400, [
            'status' => 200,
        ]);

        $client->getCodCountries('cp');
    }

    public function testRequestShouldHaveStatus(): void
    {
        $this->expectException(BadRequestException::class);

        $client = $this->newMockedClient(200, []);

        $client->getCodCountries('cp');
    }

    public function testThrowsExceptionOnBadStatusCode(): void
    {
        $this->expectException(BadRequestException::class);

        $client = $this->newMockedClient(200, [
            'status' => 400,
        ]);

        $client->getCodCountries('cp');
    }

    public function testMakeRequest(): void
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status'        => 200,
            'service_types' => [],
        ], [
            'https://apiv2.balikobot.cz/cp/cod4services',
            [],
        ]);

        $client = new Client($requester);

        $client->getCodCountries('cp');

        self::assertTrue(true);
    }

    public function testEmptyArrayIsReturnedIfUnitsMissing(): void
    {
        $client = $this->newMockedClient(200, [
            'status'        => 200,
            'service_types' => null,
        ]);

        $countries = $client->getCodCountries('cp');

        self::assertEquals([], $countries);
    }

    public function testOnlyCountriesDataAreReturned(): void
    {
        $client = $this->newMockedClient(200, [
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

        $countries = $client->getCodCountries('cp');

        self::assertEquals(
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
