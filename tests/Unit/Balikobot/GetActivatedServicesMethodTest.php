<?php

namespace Inspirum\Balikobot\Tests\Unit\Balikobot;

use Inspirum\Balikobot\Services\Balikobot;

class GetActivatedServicesMethodTest extends AbstractBalikobotTestCase
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
                'https://apiv2.balikobot.cz/cp/activatedservices',
                [],
            ]
        );

        $this->assertTrue(true);
    }

    public function testResponseData()
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
