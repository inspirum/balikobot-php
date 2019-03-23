<?php

namespace Inspirum\Balikobot\Tests\Unit\Balikobot;

use Inspirum\Balikobot\Model\Values\OrderedPackage;
use Inspirum\Balikobot\Services\Balikobot;

class TrackLastPackageTest extends AbstractBalikobotTestCase
{
    public function testMakeRequest()
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status' => 200,
            0        => [
                'status_id'   => 1,
                'status_text' => 'Zásilka byla doručena příjemci.',
            ],
        ]);

        $service = new Balikobot($requester);

        $package = new OrderedPackage(1, 'ppl', '0001', '1234');

        $service->trackPackageLastStatus($package);

        $requester->shouldHaveReceived(
            'request',
            [
                'https://api.balikobot.cz/ppl/trackstatus',
                [
                    0 => [
                        'id' => '1234',
                    ],
                ],
            ]
        );

        $this->assertTrue(true);
    }

    public function testResponseData()
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status' => 200,
            0        => [
                'status_id'   => 1,
                'status_text' => 'Zásilka byla doručena příjemci.',
            ],
        ]);

        $service = new Balikobot($requester);

        $package = new OrderedPackage(1, 'ppl', '0001', '1234');

        $status = $service->trackPackageLastStatus($package);

        $this->assertEquals(1, $status->getId());
        $this->assertEquals(null, $status->getDate());
        $this->assertEquals('Zásilka byla doručena příjemci.', $status->getName());
    }
}
