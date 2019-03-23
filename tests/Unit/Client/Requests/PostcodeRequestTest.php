<?php

namespace Inspirum\Balikobot\Tests\Unit\Client\Requests;

use Inspirum\Balikobot\Exceptions\BadRequestException;
use Inspirum\Balikobot\Services\Client;
use Inspirum\Balikobot\Tests\Unit\Client\AbstractClientTestCase;

class PostcodeRequestTest extends AbstractClientTestCase
{
    public function testThrowsExceptionOnError()
    {
        $this->expectException(BadRequestException::class);

        $requester = $this->newRequesterWithMockedRequestMethod(400, [
            'status' => 200,
        ]);

        $client = new Client($requester);

        $client->getPostCodes('cp', 'NP');
    }

    public function testRequestShouldHaveStatus()
    {
        $this->expectException(BadRequestException::class);

        $requester = $this->newRequesterWithMockedRequestMethod(200, []);

        $client = new Client($requester);

        $client->getPostCodes('cp', 'NP');
    }

    public function testThrowsExceptionOnBadStatusCode()
    {
        $this->expectException(BadRequestException::class);

        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status' => 400,
        ]);

        $client = new Client($requester);

        $client->getPostCodes('cp', 'NP');
    }

    public function testMakeRequest()
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status'    => 200,
            'zip_codes' => [],
        ]);

        $client = new Client($requester);

        $client->getPostCodes('cp', 'NP');

        $requester->shouldHaveReceived(
            'request',
            [
                'https://api.balikobot.cz/cp/zipcodes/NP',
                [],
            ]
        );

        $this->assertTrue(true);
    }

    public function testMakeRequestWithCountry()
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status'    => 200,
            'zip_codes' => [],
        ]);

        $client = new Client($requester);

        $client->getPostCodes('cp', 'NP', 'CZ');

        $requester->shouldHaveReceived(
            'request',
            [
                'https://api.balikobot.cz/cp/zipcodes/NP/CZ',
                [],
            ]
        );

        $this->assertTrue(true);
    }

    public function testEmptyArrayIsReturnedIfPostCodesMissing()
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status'    => 200,
            'zip_codes' => null,
        ]);

        $client = new Client($requester);

        $postcodes = $client->getPostCodes('cp', 'NP');

        $this->assertEquals([], $postcodes);
    }

    public function testDataAreReturnedFromResponseType1()
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
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

        $client = new Client($requester);

        $postcodes = $client->getPostCodes('cp', 'NP');

        $this->assertEquals(
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

    public function testDataAreReturnedFromResponseType2()
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
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

        $client = new Client($requester);

        $postcodes = $client->getPostCodes('cp', 'NP');

        $this->assertEquals(
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

    public function testDataAreReturnedFromResponseType4()
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
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

        $client = new Client($requester);

        $postcodes = $client->getPostCodes('cp', 'NP');

        $this->assertEquals(
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

    public function testDataAreReturnedFromResponseType5()
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
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

        $client = new Client($requester);

        $postcodes = $client->getPostCodes('cp', 'NP');

        $this->assertEquals(
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
