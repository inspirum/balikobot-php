<?php

namespace Inspirum\Balikobot\Tests\Unit\Balikobot;

use Inspirum\Balikobot\Services\Balikobot;

class GetAddServiceOptionsMethodTest extends AbstractBalikobotTestCase
{
    public function testMakeRequest()
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status'   => 200,
            'services' => [],
        ]);

        $service = new Balikobot($requester);

        $service->getAddServiceOptions('ppl');

        $requester->shouldHaveReceived(
            'request',
            [
                'https://apiv2.balikobot.cz/ppl/addserviceoptions',
                [],
            ]
        );

        $this->assertTrue(true);
    }

    public function testMakeRequestWithService()
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status'   => 200,
            'services' => [],
        ]);

        $service = new Balikobot($requester);

        $service->getAddServiceOptions('cp', 'CE');

        $requester->shouldHaveReceived(
            'request',
            [
                'https://apiv2.balikobot.cz/cp/addserviceoptions/CE',
                [],
            ]
        );

        $this->assertTrue(true);
    }

    public function testResponseData()
    {
        $service = $this->newMockedBalikobot(200, [
            'status'       => 200,
            'service_type' => 'CE',
            'services'     => [
                [
                    'name' => 'Neskladně',
                    'code' => '10',
                ],
                [
                    'name' => 'Zboží s VDD (pouze pro zásilky do ciziny s celní zónou)',
                    'code' => '44',
                ],
            ],
        ]);

        $units = $service->getAddServiceOptions('cp', 'CE');

        $this->assertEquals(
            [
                '10' => 'Neskladně',
                '44' => 'Zboží s VDD (pouze pro zásilky do ciziny s celní zónou)',
            ],
            $units
        );
    }
}
