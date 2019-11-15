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

    public function testThrowsExceptionOnBadStatusCodeForPackage()
    {
        $this->expectException(BadRequestException::class);

        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            0 => [
                'status' => 404,
            ],
        ]);

        $client = new Client($requester);

        $client->trackPackageLastStatus('cp', 1);
    }

    public function testThrowsExceptionWhenNoReturn()
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

    public function testThrowsExceptionOnErrorWithMultiplePackages()
    {
        $this->expectException(BadRequestException::class);

        $requester = $this->newRequesterWithMockedRequestMethod(400, [
            'status' => 200,
        ]);

        $client = new Client($requester);

        $client->trackPackageLastStatuses('cp', [1, 3, 4]);
    }

    public function testRequestDoesNotHaveStatusWithMultiplePackages()
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            0 => [
                'status_id'   => 1,
                'status_text' => 'Zásilka byla doručena příjemci.',
            ],
            1 => [
                'status_id'   => 2,
                'status_text' => 'Zásilka nebyla doručena příjemci.',
            ],
            2 => [
                'status_id'   => 1,
                'status_text' => 'Zásilka byla doručena příjemci.',
            ],
        ]);

        $client = new Client($requester);

        $status = $client->trackPackageLastStatuses('cp', [1, 5, 6]);

        $this->assertNotEmpty($status);
    }

    public function testThrowsExceptionOnBadStatusCodeWithMultiplePackages()
    {
        $this->expectException(BadRequestException::class);

        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status' => 400,
        ]);

        $client = new Client($requester);

        $client->trackPackageLastStatuses('cp', [1, 4]);
    }

    public function testThrowsExceptionOnBadStatusCodeForPackageWithMultiplePackages()
    {
        $this->expectException(BadRequestException::class);

        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            0 => [
                'status'      => 200,
                'status_id'   => 2,
                'status_text' => 'Zásilka nebyla doručena příjemci.',
            ],
            1 => [
                'status' => 404,
            ],
        ]);

        $client = new Client($requester);

        $client->trackPackageLastStatuses('cp', [1, 4]);
    }

    public function testThrowsExceptionWhenNoReturnWithMultiplePackages()
    {
        $this->expectException(BadRequestException::class);

        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status' => 200,
        ]);

        $client = new Client($requester);

        $client->trackPackageLastStatuses('cp', [1, 2]);
    }

    public function testThrowsExceptionWhenNotAllDataReturnWithMultiplePackages()
    {
        $this->expectException(BadRequestException::class);

        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status' => 200,
            0        => [
                'status_id'   => 1,
                'status_text' => 'Zásilka byla doručena příjemci.',
            ],
        ]);

        $client = new Client($requester);

        $client->trackPackageLastStatuses('cp', [1, 2]);
    }

    public function testMakeRequestWithMultiplePackages()
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status' => 200,
            0        => [
                'status_id'   => 1,
                'status_text' => 'Zásilka byla doručena příjemci.',
            ],
            1        => [
                'status_id'   => 1,
                'status_text' => 'Zásilka byla doručena příjemci.',
            ],
        ]);

        $client = new Client($requester);

        $client->trackPackageLastStatuses('cp', [1, 6]);

        $requester->shouldHaveReceived(
            'request',
            [
                'https://api.balikobot.cz/cp/trackstatus',
                [
                    0 => [
                        'id' => 1,
                    ],
                    1 => [
                        'id' => 6,
                    ],
                ],
            ]
        );

        $this->assertTrue(true);
    }

    public function testDataAreReturnedInV2FormatWithMultiplePackages()
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status' => 200,
            0        => [
                'status_id'   => 1,
                'status_text' => 'Zásilka byla doručena příjemci.',
            ],
            1        => [
                'status_id'   => 5,
                'status_text' => 'Zásilka nebyla doručena příjemci.',
            ],
            2        => [
                'status_id'   => 3,
                'status_text' => 'Zásilka byla doručena příjemci.',
            ],
        ]);

        $client = new Client($requester);

        $status = $client->trackPackageLastStatuses('cp', [1, 6, 5]);

        $this->assertEquals(
            [
                0 => [
                    'name'      => 'Zásilka byla doručena příjemci.',
                    'status_id' => 1,
                    'date'      => null,
                ],
                1 => [
                    'name'      => 'Zásilka nebyla doručena příjemci.',
                    'status_id' => 5,
                    'date'      => null,
                ],
                2 => [
                    'name'      => 'Zásilka byla doručena příjemci.',
                    'status_id' => 3,
                    'date'      => null,
                ],
            ],
            $status
        );
    }
}
