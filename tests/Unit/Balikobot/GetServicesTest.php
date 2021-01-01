<?php

namespace Inspirum\Balikobot\Tests\Unit\Balikobot;

use Inspirum\Balikobot\Services\Balikobot;

class GetServicesTest extends AbstractBalikobotTestCase
{
    public function testMakeRequest()
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status' => 200,
        ]);

        $service = new Balikobot($requester);

        $service->getServices('ppl');

        $requester->shouldHaveReceived(
            'request',
            [
                'https://apiv2.balikobot.cz/ppl/services',
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
                'NP' => 'NP - Balík Na poštu',
                'RR' => 'RR - Doporučená zásilka Ekonomická',
            ],
        ]);

        $service = new Balikobot($requester);

        $services = $service->getServices('ppl');

        $this->assertEquals(
            [
                'NP' => 'NP - Balík Na poštu',
                'RR' => 'RR - Doporučená zásilka Ekonomická',
            ],
            $services
        );
    }
}
