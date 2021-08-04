<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Balikobot;

use Inspirum\Balikobot\Services\Balikobot;

class GetActivatedManipulationUnitsMethodTest extends AbstractBalikobotTestCase
{
    public function testMakeRequest(): void
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status' => 200,
            'units'  => [],
        ]);

        $service = new Balikobot($requester);

        $service->getActivatedManipulationUnits('ppl');

        $requester->shouldHaveReceived(
            'request',
            [
                'https://apiv2.balikobot.cz/ppl/activatedmanipulationunits',
                [],
            ]
        );

        $this->assertTrue(true);
    }

    public function testResponseData(): void
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

        $units = $service->getActivatedManipulationUnits('cp');

        $this->assertEquals(
            [
                1   => 'KM',
                876 => 'M',
            ],
            $units
        );
    }
}
