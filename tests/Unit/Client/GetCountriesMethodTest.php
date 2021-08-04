<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Client;

use Inspirum\Balikobot\Exceptions\BadRequestException;
use Inspirum\Balikobot\Services\Client;

class GetCountriesMethodTest extends AbstractClientTestCase
{
    public function testThrowsExceptionOnError(): void
    {
        $this->expectException(BadRequestException::class);

        $client = $this->newMockedClient(400, [
            'status' => 200,
        ]);

        $client->getCountries('cp');
    }

    public function testRequestShouldHaveStatus(): void
    {
        $this->expectException(BadRequestException::class);

        $client = $this->newMockedClient(200, []);

        $client->getCountries('cp');
    }

    public function testThrowsExceptionOnBadStatusCode(): void
    {
        $this->expectException(BadRequestException::class);

        $client = $this->newMockedClient(200, [
            'status' => 400,
        ]);

        $client->getCountries('cp');
    }

    public function testMakeRequest(): void
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status'        => 200,
            'service_types' => [],
        ]);

        $client = new Client($requester);

        $client->getCountries('cp');

        $requester->shouldHaveReceived(
            'request',
            ['https://apiv2.balikobot.cz/cp/countries4service', []]
        );

        $this->assertTrue(true);
    }

    public function testEmptyArrayIsReturnedIfUnitsMissing(): void
    {
        $client = $this->newMockedClient(200, [
            'status'        => 200,
            'service_types' => null,
        ]);

        $countries = $client->getCountries('cp');

        $this->assertEquals([], $countries);
    }

    public function testOnlyCountriesDataAreReturned(): void
    {
        $client = $this->newMockedClient(200, [
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
