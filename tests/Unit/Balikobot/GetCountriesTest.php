<?php

namespace Inspirum\Balikobot\Tests\Unit\Balikobot;

use Inspirum\Balikobot\Services\Balikobot;

class GetCountriesTest extends AbstractBalikobotTestCase
{
    public function testMakeRequest()
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status'        => 200,
            'service_types' => [],
        ]);

        $service = new Balikobot($requester);

        $service->getCountries('cp');

        $requester->shouldHaveReceived(
            'request',
            [
                'https://apiv2.balikobot.cz/cp/countries4service',
                [],
            ]
        );

        $this->assertTrue(true);
    }

    public function testResponseData()
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

        $service = new Balikobot($requester);

        $units = $service->getCountries('cp');

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
            $units
        );
    }
}
