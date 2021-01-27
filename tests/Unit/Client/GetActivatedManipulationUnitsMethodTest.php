<?php

namespace Inspirum\Balikobot\Tests\Unit\Client;

use Inspirum\Balikobot\Exceptions\BadRequestException;
use Inspirum\Balikobot\Services\Client;
use Inspirum\Balikobot\Tests\Unit\Client\AbstractClientTestCase;

class GetActivatedManipulationUnitsMethodTest extends AbstractClientTestCase
{
    public function testThrowsExceptionOnError()
    {
        $this->expectException(BadRequestException::class);

        $client = $this->newMockedClient(400, [
            'status' => 200,
        ]);

        $client->getActivatedManipulationUnits('cp');
    }

    public function testRequestShouldHaveStatus()
    {
        $this->expectException(BadRequestException::class);

        $client = $this->newMockedClient(200, []);

        $client->getActivatedManipulationUnits('cp');
    }

    public function testThrowsExceptionOnBadStatusCode()
    {
        $this->expectException(BadRequestException::class);

        $client = $this->newMockedClient(200, [
            'status' => 400,
        ]);

        $client->getActivatedManipulationUnits('cp');
    }

    public function testMakeRequest()
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status' => 200,
            'units'  => [],
        ]);

        $client = new Client($requester);

        $client->getActivatedManipulationUnits('cp');

        $requester->shouldHaveReceived(
            'request',
            ['https://apiv2.balikobot.cz/cp/activatedmanipulationunits', []]
        );

        $this->assertTrue(true);
    }

    public function testEmptyArrayIsReturnedIfUnitsMissing()
    {
        $client = $this->newMockedClient(200, [
            'status' => 200,
            'units'  => null,
        ]);

        $units = $client->getActivatedManipulationUnits('cp');

        $this->assertEquals([], $units);
    }

    public function testOnlyUnitsDataAreReturned()
    {
        $client = $this->newMockedClient(200, [
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

        $units = $client->getActivatedManipulationUnits('cp');

        $this->assertEquals([1 => 'KM', 876 => 'M'], $units);
    }


    public function testFullDataAreReturned()
    {
        $client = $this->newMockedClient(200, [
            'status' => 200,
            'units'  => [
                [
                    'code' => 1,
                    'name' => 'KM',
                    'id'   => 26,
                ],
                [
                    'code' => 876,
                    'name' => 'M',
                    'id'   => 59,
                ],
            ],
        ]);

        $units = $client->getActivatedManipulationUnits('cp', true);

        $this->assertEquals(
            [
                1   => [
                    'code' => 1,
                    'name' => 'KM',
                    'id'   => 26,
                ],
                876 => [
                    'code' => 876,
                    'name' => 'M',
                    'id'   => 59,
                ],
            ],
            $units
        );
    }
}
