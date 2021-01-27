<?php

namespace Inspirum\Balikobot\Tests\Unit\Balikobot;

use Inspirum\Balikobot\Services\Balikobot;

class GetB2AServicesMethodTest extends AbstractBalikobotTestCase
{
    public function testMakeRequest()
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status' => 200,
        ]);

        $service = new Balikobot($requester);

        $service->getB2AServices('ppl');

        $requester->shouldHaveReceived(
            'request',
            [
                'https://apiv2.balikobot.cz/ppl/b2a/services',
                [],
            ]
        );

        $this->assertTrue(true);
    }

    public function testResponseData()
    {
        $service = $this->newMockedBalikobot(200, [
            'status'        => 200,
            'service_types' => [
                '1'  => 'PPL Parcel Business CZ',
                '11' => 'PPL Parcel Import SK',
            ],
        ]);

        $services = $service->getB2AServices('ppl');

        $this->assertEquals(
            [
                '1'  => 'PPL Parcel Business CZ',
                '11' => 'PPL Parcel Import SK',
            ],
            $services
        );
    }
}
