<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Balikobot;

use Inspirum\Balikobot\Services\Balikobot;

class GetActivatedServicesMethodTest extends AbstractBalikobotTestCase
{
    public function testMakeRequest(): void
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status'        => 200,
            'active_parcel' => true,
            'active_cargo'  => false,
            'service_types' => [],
        ], [
            'https://apiv2.balikobot.cz/cp/activatedservices',
            [],
        ]);

        $service = new Balikobot($requester);

        $service->getActivatedServices('cp');

        self::assertTrue(true);
    }

    public function testResponseData(): void
    {
        $service = $this->newMockedBalikobot(200, [
            'status'        => 200,
            'active_parcel' => true,
            'active_cargo'  => false,
            'service_types' => [
                'DR' => 'DR - Balík Do ruky',
                'RR' => 'RR - Doporučená zásilka',
            ],
        ]);

        $services = $service->getActivatedServices('cp');

        self::assertEquals(
            [
                'active_parcel' => true,
                'active_cargo'  => false,
                'service_types' => [
                    'DR' => 'DR - Balík Do ruky',
                    'RR' => 'RR - Doporučená zásilka',
                ],
            ],
            $services
        );
    }
}
