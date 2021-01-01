<?php

namespace Inspirum\Balikobot\Tests\Unit\Client;

use Inspirum\Balikobot\Exceptions\BadRequestException;
use Inspirum\Balikobot\Services\Client;
use Inspirum\Balikobot\Tests\Unit\Client\AbstractClientTestCase;

class CountriesRequestTest extends AbstractClientTestCase
{
    public function testThrowsExceptionOnError()
    {
        $this->expectException(BadRequestException::class);

        $requester = $this->newRequesterWithMockedRequestMethod(400, [
            'status' => 200,
        ]);

        $client = new Client($requester);

        $client->getCountries('cp');
    }

    public function testRequestShouldHaveStatus()
    {
        $this->expectException(BadRequestException::class);

        $requester = $this->newRequesterWithMockedRequestMethod(200, []);

        $client = new Client($requester);

        $client->getCountries('cp');
    }

    public function testThrowsExceptionOnBadStatusCode()
    {
        $this->expectException(BadRequestException::class);

        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status' => 400,
        ]);

        $client = new Client($requester);

        $client->getCountries('cp');
    }

    public function testMakeRequest()
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status'        => 200,
            'service_types' => [],
        ]);

        $client = new Client($requester);

        $client->getCountries('cp');

        $requester->shouldHaveReceived(
            'request',
            ['https://api.balikobot.cz/cp/countries4service', []]
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

        $countries = $client->getCountries('cp');

        $this->assertEquals([], $countries);
    }

    public function testOnlyCountriesDataAreReturned()
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status'        => 200,
            'service_types' => [
                [
                    'service_type' => 1,
                    'countries'    => [
                        'CZ',
                        'UK',
                        'DE',
                    ],
                ],
                [
                    'service_type' => 4,
                    'countries'    => [
                        'CZ',
                        'SK',
                    ],
                ],
            ],
        ]);

        $client = new Client($requester);

        $countries = $client->getCountries('cp');

        $this->assertEquals(
            [
                1 => [
                    'CZ',
                    'UK',
                    'DE',
                ],
                4 => [
                    'CZ',
                    'SK',
                ],
            ],
            $countries
        );
    }
}
