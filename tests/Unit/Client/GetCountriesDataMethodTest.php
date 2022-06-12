<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Client;

use Inspirum\Balikobot\Exceptions\BadRequestException;
use Inspirum\Balikobot\Services\Client;

class GetCountriesDataMethodTest extends AbstractClientTestCase
{
    public function testThrowsExceptionOnError(): void
    {
        $this->expectException(BadRequestException::class);

        $client = $this->newMockedClient(400, [
            'status' => 200,
        ]);

        $client->getCountriesData();
    }

    public function testRequestShouldHaveStatus(): void
    {
        $this->expectException(BadRequestException::class);

        $client = $this->newMockedClient(200, []);

        $client->getCountriesData();
    }

    public function testThrowsExceptionOnBadStatusCode(): void
    {
        $this->expectException(BadRequestException::class);

        $client = $this->newMockedClient(200, [
            'status' => 400,
        ]);

        $client->getCountriesData();
    }

    public function testMakeRequest(): void
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status'        => 200,
            'service_types' => [],
        ], [
            'https://apiv2.balikobot.cz/getCountriesData',
            [],
        ]);

        $client = new Client($requester);

        $client->getCountriesData();

        self::assertTrue(true);
    }

    public function testEmptyArrayIsReturnedIfUnitsMissing(): void
    {
        $client = $this->newMockedClient(200, [
            'status'    => 200,
            'countries' => null,
        ]);

        $countries = $client->getCountriesData();

        self::assertEquals([], $countries);
    }

    public function testOnlyCountriesDataAreReturned(): void
    {
        $client = $this->newMockedClient(200, [
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

        $countries = $client->getCountriesData();

        self::assertEquals(
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
