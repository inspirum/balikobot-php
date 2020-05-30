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
                    'name'      => 'Doručování zásilky. 10003 Depo Praha 701',
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

    public function testThrowsExceptionWhenNoDataReturn()
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
                [
                    'date'      => '2018-11-07 14:15:01',
                    'name'      => 'Doručení',
                    'status_id' => 2,
                ],
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

    public function testThrowsExceptionOnErrorWithMultiplePackages()
    {
        $this->expectException(BadRequestException::class);

        $requester = $this->newRequesterWithMockedRequestMethod(400, [
            'status' => 200,
        ]);

        $client = new Client($requester);

        $client->trackPackages('cp', [1, 2, 4]);
    }

    public function testRequestShouldNotHaveStatusWithMultiplePackages()
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
                    'name'      => 'Doručování zásilky. 10003 Depo Praha 701',
                ],
            ],
            1 => [
                [
                    'date'      => '2018-07-02 00:00:00',
                    'status_id' => 2,
                    'name'      => 'Dodání zásilky. 10005 Depo Praha 701',
                ],
            ],
            2 => [
                [
                    'date'      => '2018-07-02 00:00:00',
                    'status_id' => 1,
                    'name'      => 'Doručování zásilky. 10003 Depo Praha 701',
                ],
            ],
        ]);

        $client = new Client($requester);

        $status = $client->trackPackages('cp', [3, 4, 5]);

        $this->assertNotEmpty($status);
    }

    public function testThrowsExceptionOnBadPackageIndexes()
    {
        $this->expectException(BadRequestException::class);

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
                    'name'      => 'Doručování zásilky. 10003 Depo Praha 701',
                ],
            ],
            2 => [
                [
                    'date'      => '2018-07-02 00:00:00',
                    'status_id' => 2,
                    'name'      => 'Dodání zásilky. 10005 Depo Praha 701',
                ],
            ],
            3 => [
                [
                    'date'      => '2018-07-02 00:00:00',
                    'status_id' => 1,
                    'name'      => 'Doručování zásilky. 10003 Depo Praha 701',
                ],
            ],
        ]);

        $client = new Client($requester);

        $client->trackPackages('cp', [3, 4, 5]);
    }

    public function testThrowsExceptionOnBadStatusCodeWithMultiplePackages()
    {
        $this->expectException(BadRequestException::class);

        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status' => 400,
        ]);

        $client = new Client($requester);

        $client->trackPackages('cp', [4, 2]);
    }

    public function testThrowsExceptionWhenNoDataReturnWithMultiplePackages()
    {
        $this->expectException(BadRequestException::class);

        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status' => 200,
        ]);

        $client = new Client($requester);

        $client->trackPackages('cp', [1, 3]);
    }

    public function testThrowsExceptionWhenNotAllDataReturnWithMultiplePackages()
    {
        $this->expectException(BadRequestException::class);

        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status' => 200,
            1        => [
                [
                    'date'      => '2018-07-02 00:00:00',
                    'status_id' => 2,
                    'name'      => 'Dodání zásilky. 10005 Depo Praha 701',
                ],
            ],
        ]);

        $client = new Client($requester);

        $client->trackPackages('ppl', [1, 3]);
    }

    public function testMakeRequestWithMultiplePackages()
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
            1        => [
                [
                    'date'      => '2018-11-07 14:15:01',
                    'name'      => 'Doručení',
                    'status_id' => 2,
                ],
            ],
            2        => [
                [
                    'date'      => '2018-11-07 14:15:01',
                    'name'      => 'Doručení',
                    'status_id' => 2,
                ],
            ],
        ]);

        $client = new Client($requester);

        $client->trackPackages('cp', [1, 33, 4]);

        $requester->shouldHaveReceived(
            'request',
            [
                'https://api.balikobot.cz/v2/cp/track',
                [
                    0 => [
                        'id' => 1,
                    ],
                    1 => [
                        'id' => 33,
                    ],
                    2 => [
                        'id' => 4,
                    ],
                ],
            ]
        );

        $this->assertTrue(true);
    }

    public function testGlsOnlyReturnsLastPackageStatusesWithMultiplePackages()
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status' => 200,
            1        => [
                [
                    'date'      => '2018-07-02 00:00:00',
                    'status_id' => 2,
                    'name'      => 'Doručení',
                ],
                [
                    'date'      => '2018-07-01 00:00:00',
                    'status_id' => 1,
                    'name'      => 'Dodání zásilky. 10005 Depo Praha 701',
                ],
            ],
        ]);

        $client = new Client($requester);

        $statuses = $client->trackPackages('gls', [1, 3]);

        $this->assertEquals([], $statuses[0]);
        $this->assertEquals(
            [
                [
                    'date'      => '2018-07-02 00:00:00',
                    'status_id' => 2,
                    'name'      => 'Doručení',
                ],
                [
                    'date'      => '2018-07-01 00:00:00',
                    'status_id' => 1,
                    'name'      => 'Dodání zásilky. 10005 Depo Praha 701',
                ],
            ],
            $statuses[1]
        );
    }
}
