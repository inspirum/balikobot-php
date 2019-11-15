<?php

namespace Inspirum\Balikobot\Tests\Unit\Client\Requests;

use Inspirum\Balikobot\Exceptions\BadRequestException;
use Inspirum\Balikobot\Services\Client;
use Inspirum\Balikobot\Tests\Unit\Client\AbstractClientTestCase;

class PODRequestTest extends AbstractClientTestCase
{
    public function testThrowsExceptionOnError()
    {
        $this->expectException(BadRequestException::class);

        $requester = $this->newRequesterWithMockedRequestMethod(400, [
            'status' => 200,
        ]);

        $client = new Client($requester);

        $client->getProofOfDelivery('cp', 1);
    }

    public function testRequestDoesNotHaveStatus()
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            0 => [
                'status'   => 200,
                'file_url' => 'https://pod.balikobot.cz/tnt/eNorMTY11DUEXDAFrwFs',
            ],
        ]);

        $client = new Client($requester);

        $status = $client->getProofOfDelivery('cp', 1);

        $this->assertNotEmpty($status);
    }

    public function testThrowsExceptionOnBadStatusCode()
    {
        $this->expectException(BadRequestException::class);

        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status' => 400,
        ]);

        $client = new Client($requester);

        $client->getProofOfDelivery('cp', 1);
    }

    public function testThrowsExceptionOnBadStatusCodeForPackage()
    {
        $this->expectException(BadRequestException::class);

        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            1 => [
                'status' => 404,
            ],
        ]);

        $client = new Client($requester);

        $client->getProofOfDelivery('cp', 1);
    }

    public function testThrowsExceptionWhenNoReturn()
    {
        $this->expectException(BadRequestException::class);

        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status' => 200,
        ]);

        $client = new Client($requester);

        $client->getProofOfDelivery('cp', 1);
    }

    public function testMakeRequest()
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status' => 200,
            0        => [
                'status'   => 200,
                'file_url' => 'https://pod.balikobot.cz/tnt/eNorMTY11DUEXDAFrwFs',
            ],
        ]);

        $client = new Client($requester);

        $client->getProofOfDelivery('cp', 1);

        $requester->shouldHaveReceived(
            'request',
            [
                'https://api.balikobot.cz/cp/pod',
                [
                    0 => [
                        'id' => 1,
                    ],
                ],
            ]
        );

        $this->assertTrue(true);
    }

    public function testDataAreReturnedInFormat()
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status' => 200,
            0        => [
                'status'   => 200,
                'file_url' => 'https://pod.balikobot.cz/tnt/eNorMTY11DUEXDAFrwFs',
            ],
        ]);

        $client = new Client($requester);

        $link = $client->getProofOfDelivery('cp', 1);

        $this->assertEquals('https://pod.balikobot.cz/tnt/eNorMTY11DUEXDAFrwFs', $link);
    }

    public function testThrowsExceptionOnErrorWithMultiplePackages()
    {
        $this->expectException(BadRequestException::class);

        $requester = $this->newRequesterWithMockedRequestMethod(400, [
            'status' => 200,
        ]);

        $client = new Client($requester);

        $client->getProofOfDeliveries('cp', [1, 3, 4]);
    }

    public function testRequestDoesNotHaveStatusWithMultiplePackages()
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            0 => [
                'status'   => 200,
                'file_url' => 'https://pod.balikobot.cz/tnt/eNorMTY11DUEXDAFrwFs',
            ],
            1 => [
                'status'   => 200,
                'file_url' => 'https://pod.balikobot.cz/tnt/eNorMTY11DUEXDAFrwFs',
            ],
            2 => [
                'status'   => 200,
                'file_url' => 'https://pod.balikobot.cz/tnt/eNorMTY11DUEXDAFrwFs',
            ],
        ]);

        $client = new Client($requester);

        $status = $client->getProofOfDeliveries('cp', [1, 5, 6]);

        $this->assertNotEmpty($status);
    }

    public function testThrowsExceptionOnBadStatusCodeWithMultiplePackages()
    {
        $this->expectException(BadRequestException::class);

        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status' => 400,
        ]);

        $client = new Client($requester);

        $client->getProofOfDeliveries('cp', [1, 4]);
    }

    public function testThrowsExceptionOnBadStatusCodeForPackageWithMultiplePackages()
    {
        $this->expectException(BadRequestException::class);

        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            0 => [
                'status'   => 200,
                'file_url' => 'https://pod.balikobot.cz/tnt/eNorMTY11DUEXDAFrwFs',
            ],
            1 => [
                'status' => 404,
            ],
        ]);

        $client = new Client($requester);

        $client->getProofOfDeliveries('cp', [1, 4]);
    }

    public function testThrowsExceptionWhenNoReturnWithMultiplePackages()
    {
        $this->expectException(BadRequestException::class);

        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status' => 200,
        ]);

        $client = new Client($requester);

        $client->getProofOfDeliveries('cp', [1, 2]);
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

        $client->getProofOfDeliveries('cp', [1, 2]);
    }

    public function testMakeRequestWithMultiplePackages()
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status' => 200,
            0        => [
                'status'   => 200,
                'file_url' => 'https://pod.balikobot.cz/tnt/eNorMTY11DUEXDAFrwFs',
            ],
            1        => [
                'status'   => 200,
                'file_url' => 'https://pod.balikobot.cz/tnt/eNorMTY11DUEXDAFrwFs',
            ],
        ]);

        $client = new Client($requester);

        $client->getProofOfDeliveries('cp', [1, 6]);

        $requester->shouldHaveReceived(
            'request',
            [
                'https://api.balikobot.cz/cp/pod',
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

    public function testDataAreReturnedInFormatWithMultiplePackages()
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status' => 200,
            0        => [
                'status'   => 200,
                'file_url' => 'https://pod.balikobot.cz/tnt/eNorMTY11DUEXDAFrwFs',
            ],
            1        => [
                'status'   => 200,
                'file_url' => 'https://pod.balikobot.cz/tnt/eNorMTY11DUEXDAFrwFa',
            ],
            2        => [
                'status'   => 200,
                'file_url' => 'https://pod.balikobot.cz/tnt/eNorMTY11DUEXDAFrwFb',
            ],
        ]);

        $client = new Client($requester);

        $links = $client->getProofOfDeliveries('cp', [1, 6, 5]);

        $this->assertEquals(
            [
                0 => 'https://pod.balikobot.cz/tnt/eNorMTY11DUEXDAFrwFs',
                1 => 'https://pod.balikobot.cz/tnt/eNorMTY11DUEXDAFrwFa',
                2 => 'https://pod.balikobot.cz/tnt/eNorMTY11DUEXDAFrwFb',
            ],
            $links
        );
    }
}
