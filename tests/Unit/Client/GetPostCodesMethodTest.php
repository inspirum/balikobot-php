<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Client;

use Inspirum\Balikobot\Exceptions\BadRequestException;
use Inspirum\Balikobot\Services\Client;

class GetPostCodesMethodTest extends AbstractClientTestCase
{
    public function testThrowsExceptionOnError(): void
    {
        $this->expectException(BadRequestException::class);

        $client = $this->newMockedClient(400, [
            'status' => 200,
        ]);

        $client->getPostCodes('cp', 'NP');
    }

    public function testRequestShouldHaveStatus(): void
    {
        $this->expectException(BadRequestException::class);

        $client = $this->newMockedClient(200, []);

        $client->getPostCodes('cp', 'NP');
    }

    public function testThrowsExceptionOnBadStatusCode(): void
    {
        $this->expectException(BadRequestException::class);

        $client = $this->newMockedClient(200, [
            'status' => 400,
        ]);

        $client->getPostCodes('cp', 'NP');
    }

    public function testMakeRequest(): void
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status'    => 200,
            'zip_codes' => [],
        ], [
            'https://apiv2.balikobot.cz/cp/zipcodes/NP',
            [],
        ]);

        $client = new Client($requester);

        $client->getPostCodes('cp', 'NP');

        self::assertTrue(true);
    }

    public function testMakeRequestWithCountry(): void
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status'    => 200,
            'zip_codes' => [],
        ], [
            'https://apiv2.balikobot.cz/cp/zipcodes/NP/CZ',
            [],
        ]);

        $client = new Client($requester);

        $client->getPostCodes('cp', 'NP', 'CZ');

        self::assertTrue(true);
    }

    public function testEmptyArrayIsReturnedIfPostCodesMissing(): void
    {
        $client = $this->newMockedClient(200, [
            'status'    => 200,
            'zip_codes' => null,
        ]);

        $postcodes = $client->getPostCodes('cp', 'NP');

        self::assertEquals([], $postcodes);
    }

    public function testDataAreReturnedFromResponseType1(): void
    {
        $client = $this->newMockedClient(200, [
            'status'       => 200,
            'service_type' => 'NP',
            'type'         => 'zip',
            'zip_codes'    => [
                [
                    'zip'     => '35002',
                    '1B'      => false,
                    'country' => 'CZ',
                ],
                [
                    'zip'     => '19000',
                    '1B'      => true,
                    'country' => 'CZ',
                ],
            ],
        ]);

        $postcodes = $client->getPostCodes('cp', 'NP');

        self::assertEquals(
            [
                [
                    'postcode'     => '35002',
                    'postcode_end' => null,
                    'city'         => null,
                    'country'      => 'CZ',
                    '1B'           => false,
                ],
                [
                    'postcode'     => '19000',
                    'postcode_end' => null,
                    'city'         => null,
                    'country'      => 'CZ',
                    '1B'           => true,
                ],
            ],
            $postcodes
        );
    }

    public function testDataAreReturnedFromResponseType2(): void
    {
        $client = $this->newMockedClient(200, [
            'status'       => 200,
            'service_type' => '1',
            'type'         => 'zip_range',
            'zip_codes'    => [
                [
                    'zip_start' => '10000',
                    'zip_end'   => '10199',
                    'country'   => 'CZ',
                ],
                [
                    'zip_start' => '35000',
                    'zip_end'   => '35299',
                    'country'   => 'CZ',
                ],
            ],
        ]);

        $postcodes = $client->getPostCodes('cp', 'NP');

        self::assertEquals(
            [
                [
                    'postcode'     => '10000',
                    'postcode_end' => '10199',
                    'city'         => null,
                    'country'      => 'CZ',
                    '1B'           => false,
                ],
                [
                    'postcode'     => '35000',
                    'postcode_end' => '35299',
                    'city'         => null,
                    'country'      => 'CZ',
                    '1B'           => false,
                ],
            ],
            $postcodes
        );
    }

    public function testDataAreReturnedFromResponseType4(): void
    {
        $client = $this->newMockedClient(200, [
            'status'       => 200,
            'service_type' => '1',
            'type'         => 'zip_range',
            'country'      => 'AD',
            'zip_codes'    => [
                [
                    'city'      => 'AIXIRIVALL',
                    'zip_start' => '25999',
                    'zip_end'   => '25999',
                ],
            ],
        ]);

        $postcodes = $client->getPostCodes('cp', 'NP');

        self::assertEquals(
            [
                [
                    'postcode'     => '25999',
                    'postcode_end' => '25999',
                    'city'         => 'AIXIRIVALL',
                    'country'      => 'AD',
                    '1B'           => false,
                ],
            ],
            $postcodes
        );
    }

    public function testDataAreReturnedFromResponseType5(): void
    {
        $client = $this->newMockedClient(200, [
            'status'       => 200,
            'service_type' => '1',
            'type'         => 'city',
            'country'      => 'AE',
            'zip_codes'    => [
                [
                    'city' => 'ABU DHABI',
                ],
                [
                    'city' => 'AJMAN CITY',
                ],
            ],
        ]);

        $postcodes = $client->getPostCodes('cp', 'NP');

        self::assertEquals(
            [
                [
                    'postcode'     => null,
                    'postcode_end' => null,
                    'city'         => 'ABU DHABI',
                    'country'      => 'AE',
                    '1B'           => false,
                ],
                [
                    'postcode'     => null,
                    'postcode_end' => null,
                    'city'         => 'AJMAN CITY',
                    'country'      => 'AE',
                    '1B'           => false,
                ],
            ],
            $postcodes
        );
    }
}
