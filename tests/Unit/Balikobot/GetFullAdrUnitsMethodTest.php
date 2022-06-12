<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Balikobot;

use Inspirum\Balikobot\Model\Values\AdrUnit;
use Inspirum\Balikobot\Services\Balikobot;

class GetFullAdrUnitsMethodTest extends AbstractBalikobotTestCase
{
    public function testMakeRequest(): void
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status' => 200,
            'units'  => [],
        ], [
            'https://apiv2.balikobot.cz/toptrans/fulladrunits',
            [],
        ]);

        $service = new Balikobot($requester);

        $service->getFullAdrUnits('toptrans');

        self::assertTrue(true);
    }

    public function testResponseData(): void
    {
        $service = $this->newMockedBalikobot(200, [
            'status' => 200,
            'units'  => [
                [
                    'id'                 => '299',
                    'code'               => '432',
                    'name'               => 'PŘEDMĚTY PYROTECHNICKÉ pro technické účely',
                    'class'              => '1',
                    'packaging'          => null,
                    'tunnel_code'        => 'E',
                    'transport_category' => '4',
                ],
                [
                    'id'                 => '377',
                    'code'               => '1001',
                    'name'               => 'ACETYLÉN, ROZPUŠTĚNÝ',
                    'class'              => '2',
                    'packaging'          => null,
                    'tunnel_code'        => null,
                    'transport_category' => '2',
                ],
            ],
        ]);

        $units = $service->getFullAdrUnits('toptrans');

        self::assertEquals(
            [
                '432'   => new AdrUnit(
                    'toptrans',
                    '299',
                    '432',
                    'PŘEDMĚTY PYROTECHNICKÉ pro technické účely',
                    '1',
                    null,
                    'E',
                    '4',
                ),
                '1001' => new AdrUnit(
                    'toptrans',
                    '377',
                    '1001',
                    'ACETYLÉN, ROZPUŠTĚNÝ',
                    '2',
                    null,
                    null,
                    '2',
                ),
            ],
            $units
        );
    }
}
