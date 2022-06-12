<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Balikobot;

use Inspirum\Balikobot\Services\Balikobot;

class GetAdrUnitsMethodTest extends AbstractBalikobotTestCase
{
    public function testMakeRequest(): void
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status' => 200,
            'units'  => [],
        ], [
            'https://apiv2.balikobot.cz/ppl/adrunits',
            [],
        ]);

        $service = new Balikobot($requester);

        $service->getAdrUnits('ppl');

        self::assertTrue(true);
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

        $units = $service->getAdrUnits('cp');

        self::assertEquals(
            [
                1   => 'KM',
                876 => 'M',
            ],
            $units
        );
    }
}
