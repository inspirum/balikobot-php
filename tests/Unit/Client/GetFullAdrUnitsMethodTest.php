<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Client;

use Inspirum\Balikobot\Exceptions\BadRequestException;
use Inspirum\Balikobot\Services\Client;

class GetFullAdrUnitsMethodTest extends AbstractClientTestCase
{
    public function testThrowsExceptionOnError(): void
    {
        $this->expectException(BadRequestException::class);

        $client = $this->newMockedClient(400, [
            'status' => 200,
        ]);

        $client->getFullAdrUnits('toptrans');
    }

    public function testRequestShouldHaveStatus(): void
    {
        $this->expectException(BadRequestException::class);

        $client = $this->newMockedClient(200, []);

        $client->getFullAdrUnits('toptrans');
    }

    public function testThrowsExceptionOnBadStatusCode(): void
    {
        $this->expectException(BadRequestException::class);

        $client = $this->newMockedClient(200, [
            'status' => 400,
        ]);

        $client->getFullAdrUnits('toptrans');
    }

    public function testMakeRequest(): void
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status' => 200,
            'units'  => [],
        ]);

        $client = new Client($requester);

        $client->getFullAdrUnits('toptrans');

        $requester->shouldHaveReceived(
            'request',
            ['https://apiv2.balikobot.cz/toptrans/fulladrunits', []]
        );

        self::assertTrue(true);
    }

    public function testEmptyArrayIsReturnedIfUnitsMissing(): void
    {
        $client = $this->newMockedClient(200, [
            'status' => 200,
            'units'  => null,
        ]);

        $units = $client->getFullAdrUnits('toptrans');

        self::assertEquals([], $units);
    }

    public function testOnlyUnitsDataAreReturned(): void
    {
        $client = $this->newMockedClient(200, [
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

        $units = $client->getFullAdrUnits('toptrans');

        self::assertEquals(
            [
                '432' => [
                    'id'                 => '299',
                    'code'               => '432',
                    'name'               => 'PŘEDMĚTY PYROTECHNICKÉ pro technické účely',
                    'class'              => '1',
                    'packaging'          => null,
                    'tunnel_code'        => 'E',
                    'transport_category' => '4',
                ],
                '1001' => [
                    'id'                 => '377',
                    'code'               => '1001',
                    'name'               => 'ACETYLÉN, ROZPUŠTĚNÝ',
                    'class'              => '2',
                    'packaging'          => null,
                    'tunnel_code'        => null,
                    'transport_category' => '2',
                ],
            ],
            $units
        );
    }
}
