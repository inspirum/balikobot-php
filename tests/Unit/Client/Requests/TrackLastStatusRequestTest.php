<?php

namespace Inspirum\Balikobot\Tests\Unit\Client\Requests;

use Inspirum\Balikobot\Exceptions\BadRequestException;
use Inspirum\Balikobot\Services\Client;
use Inspirum\Balikobot\Tests\Unit\Client\AbstractClientTestCase;

class TrackLastStatusRequestTest extends AbstractClientTestCase
{
    public function testThrowsExceptionOnError()
    {
        $this->expectException(BadRequestException::class);

        $requester = $this->newRequesterWithMockedRequestMethod(400, [
            'status' => 200,
        ]);

        $client = new Client($requester);

        $client->trackPackageLastStatus('cp', 1);
    }

    public function testRequestDoesNotHaveStatus()
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            0 => [
                'status_id'   => 1,
                'status_text' => 'Zásilka byla doručena příjemci.',
            ],
        ]);

        $client = new Client($requester);

        $status = $client->trackPackageLastStatus('cp', 1);

        $this->assertNotEmpty($status);
    }

    public function testThrowsExceptionOnBadStatusCode()
    {
        $this->expectException(BadRequestException::class);

        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status' => 400,
        ]);

        $client = new Client($requester);

        $client->trackPackageLastStatus('cp', 1);
    }

    public function testThrowsExceptionWhenNoReturnStatus()
    {
        $this->expectException(BadRequestException::class);

        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status' => 200,
        ]);

        $client = new Client($requester);

        $client->trackPackageLastStatus('cp', 1);
    }

    public function testMakeRequest()
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status' => 200,
            0        => [
                'status_id'   => 1,
                'status_text' => 'Zásilka byla doručena příjemci.',
            ],
        ]);

        $client = new Client($requester);

        $client->trackPackageLastStatus('cp', 1);

        $requester->shouldHaveReceived(
            'request',
            [
                'https://api.balikobot.cz/cp/trackstatus',
                [
                    0 => [
                        'id' => 1,
                    ],
                ],
            ]
        );

        $this->assertTrue(true);
    }

    public function testDataAreReturnedInV2Format()
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status' => 200,
            0        => [
                'status_id'   => 1,
                'status_text' => 'Zásilka byla doručena příjemci.',
            ],
        ]);

        $client = new Client($requester);

        $status = $client->trackPackageLastStatus('cp', 1);

        $this->assertEquals(
            [
                'name'      => 'Zásilka byla doručena příjemci.',
                'status_id' => 1,
                'date'      => null,
            ],
            $status
        );
    }
}
