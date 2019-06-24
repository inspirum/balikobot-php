<?php

namespace Inspirum\Balikobot\Tests\Unit\Client\Requests;

use Inspirum\Balikobot\Exceptions\BadRequestException;
use Inspirum\Balikobot\Services\Client;
use Inspirum\Balikobot\Tests\Unit\Client\AbstractClientTestCase;

class TrackRequestTest extends AbstractClientTestCase
{
    public function testThrowsExceptionOnError()
    {
        $this->expectException(BadRequestException::class);

        $requester = $this->newRequesterWithMockedRequestMethod(400, [
            'status' => 200,
        ]);

        $client = new Client($requester);

        $client->trackPackage('cp', 1);
    }

    public function testRequestShouldHaveStatus()
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            0 => [
                [
                    'date'      => '2018-07-02 00:00:00',
                    'status_id' => 2,
                    'name'      => 'Dodání zásilky. 10003 Depo Praha 701',
                ],
                [
                    'date'      => '2018-07-02 00:00:00',
                    'status_id' => 1,
                    'name'      => '"Doručování zásilky. 10003 Depo Praha 701',
                ],
            ],
        ]);

        $client = new Client($requester);

        $status = $client->trackPackage('cp', 1);

        $this->assertNotEmpty($status);
    }

    public function testThrowsExceptionOnBadStatusCode()
    {
        $this->expectException(BadRequestException::class);

        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status' => 400,
        ]);

        $client = new Client($requester);

        $client->trackPackage('cp', 1);
    }

    public function testThrowsExceptionWhenNoReturnStatus()
    {
        $this->expectException(BadRequestException::class);

        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status' => 200,
        ]);

        $client = new Client($requester);

        $client->trackPackage('cp', 1);
    }

    public function testMakeRequest()
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status' => 200,
            0        => [
                'date'      => '2018-11-07 14:15:01',
                'name'      => 'Doručení',
                'status_id' => 2,
            ],
        ]);

        $client = new Client($requester);

        $client->trackPackage('cp', 1);

        $requester->shouldHaveReceived(
            'request',
            [
                'https://api.balikobot.cz/v2/cp/track',
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
                [
                    'date'      => '2018-11-07 14:15:01',
                    'name'      => 'Doručení',
                    'status_id' => 2,
                ],
            ],
        ]);

        $client = new Client($requester);

        $status = $client->trackPackage('cp', 1);

        $this->assertEquals(
            [
                [
                    'date'      => '2018-11-07 14:15:01',
                    'name'      => 'Doručení',
                    'status_id' => 2,
                ],
            ],
            $status
        );
    }
}
