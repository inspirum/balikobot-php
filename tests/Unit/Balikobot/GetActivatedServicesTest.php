<?php

namespace Inspirum\Balikobot\Tests\Unit\Balikobot;

use Inspirum\Balikobot\Services\Balikobot;

class GetActivatedServicesTest extends AbstractBalikobotTestCase
{
    public function testMakeRequest()
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status'        => 200,
            'active_parcel' => true,
            'active_cargo'  => false,
            'service_types' => [],
        ]);

        $service = new Balikobot($requester);

        $service->getActivatedServices('cp');

        $requester->shouldHaveReceived(
            'request',
            [
                'https://api.balikobot.cz/cp/activatedservices',
                [],
            ]
        );

        $this->assertTrue(true);
    }

    public function testResponseData()
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status'        => 200,
            'active_parcel' => true,
            'active_cargo'  => false,
            'service_types' => [
                'DR' => 'DR - Balík Do ruky',
                'RR' => 'RR - Doporučená zásilka',
            ],
        ]);

        $service = new Balikobot($requester);

        $services = $service->getActivatedServices('cp');

        $this->assertEquals(
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
