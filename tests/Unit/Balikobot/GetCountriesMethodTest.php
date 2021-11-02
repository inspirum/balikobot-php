<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Balikobot;

use Inspirum\Balikobot\Services\Balikobot;

class GetCountriesMethodTest extends AbstractBalikobotTestCase
{
    public function testMakeRequest(): void
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

        self::assertTrue(true);
    }

    public function testResponseData(): void
    {
        $service = $this->newMockedBalikobot(200, [
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

        $units = $service->getCountries('cp');

        self::assertEquals(
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
