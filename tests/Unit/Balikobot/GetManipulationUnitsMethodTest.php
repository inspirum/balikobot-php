<?php

namespace Inspirum\Balikobot\Tests\Unit\Balikobot;

use Inspirum\Balikobot\Services\Balikobot;

class GetManipulationUnitsMethodTest extends AbstractBalikobotTestCase
{
    public function testMakeRequest()
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status' => 200,
            'units'  => [],
        ]);

        $service = new Balikobot($requester);

        $service->getManipulationUnits('ppl');

        $requester->shouldHaveReceived(
            'request',
            [
                'https://apiv2.balikobot.cz/ppl/manipulationunits',
                [],
            ]
        );

        $this->assertTrue(true);
    }

    public function testResponseData()
    {
        $service = $this->newMockedBalikobot(200, [
            'status' => 200,
            'units'  => [
                [
                    'code' => 1,
                    'name' => 'KM',
                    'attr' => 4,
                ],
                [
                    'code' => 876,
                    'name' => 'M',
                ],
            ],
        ]);

        $units = $service->getManipulationUnits('cp');

        $this->assertEquals(
            [
                1   => 'KM',
                876 => 'M',
            ],
            $units
        );
    }
}
