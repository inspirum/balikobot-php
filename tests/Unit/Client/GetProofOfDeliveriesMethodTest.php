<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Client;

use Inspirum\Balikobot\Exceptions\BadRequestException;
use Inspirum\Balikobot\Services\Client;

class GetProofOfDeliveriesMethodTest extends AbstractClientTestCase
{
    public function testThrowsExceptionOnError(): void
    {
        $this->expectException(BadRequestException::class);

        $client = $this->newMockedClient(400, [
            'status' => 200,
        ]);

        $client->getProofOfDelivery('cp', '1');
    }

    public function testRequestDoesNotHaveStatus(): void
    {
        $client = $this->newMockedClient(200, [
            0 => [
                'status'   => 200,
                'file_url' => 'https://pod.balikobot.cz/tnt/eNorMTY11DUEXDAFrwFs',
            ],
        ]);

        $status = $client->getProofOfDelivery('cp', '1');

        $this->assertNotEmpty($status);
    }

    public function testThrowsExceptionOnBadStatusCode(): void
    {
        $this->expectException(BadRequestException::class);

        $client = $this->newMockedClient(200, [
            'status' => 400,
        ]);

        $client->getProofOfDelivery('cp', '1');
    }

    public function testThrowsExceptionOnBadStatusCodeForPackage(): void
    {
        $this->expectException(BadRequestException::class);

        $client = $this->newMockedClient(200, [
            1 => [
                'status' => 404,
            ],
        ]);

        $client->getProofOfDelivery('cp', '1');
    }

    public function testThrowsExceptionWhenNoReturn(): void
    {
        $this->expectException(BadRequestException::class);

        $client = $this->newMockedClient(200, [
            'status' => 200,
        ]);

        $client->getProofOfDelivery('cp', '1');
    }

    public function testMakeRequest(): void
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status' => 200,
            0        => [
                'status'   => 200,
                'file_url' => 'https://pod.balikobot.cz/tnt/eNorMTY11DUEXDAFrwFs',
            ],
        ]);

        $client = new Client($requester);

        $client->getProofOfDelivery('cp', '1');

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

    public function testDataAreReturnedInFormat(): void
    {
        $client = $this->newMockedClient(200, [
            'status' => 200,
            0        => [
                'status'   => 200,
                'file_url' => 'https://pod.balikobot.cz/tnt/eNorMTY11DUEXDAFrwFs',
            ],
        ]);

        $link = $client->getProofOfDelivery('cp', '1');

        $this->assertEquals('https://pod.balikobot.cz/tnt/eNorMTY11DUEXDAFrwFs', $link);
    }

    public function testThrowsExceptionOnErrorWithMultiplePackages(): void
    {
        $this->expectException(BadRequestException::class);

        $client = $this->newMockedClient(400, [
            'status' => 200,
        ]);

        $client->getProofOfDeliveries('cp', ['1', '3', '4']);
    }

    public function testRequestDoesNotHaveStatusWithMultiplePackages(): void
    {
        $client = $this->newMockedClient(200, [
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

        $status = $client->getProofOfDeliveries('cp', ['1', '5', '6']);

        $this->assertNotEmpty($status);
    }

    public function testThrowsExceptionOnBadStatusCodeWithMultiplePackages(): void
    {
        $this->expectException(BadRequestException::class);

        $client = $this->newMockedClient(200, [
            'status' => 400,
        ]);

        $client->getProofOfDeliveries('cp', ['1', '4']);
    }

    public function testThrowsExceptionOnBadStatusCodeForPackageWithMultiplePackages(): void
    {
        $this->expectException(BadRequestException::class);

        $client = $this->newMockedClient(200, [
            0 => [
                'status'   => 200,
                'file_url' => 'https://pod.balikobot.cz/tnt/eNorMTY11DUEXDAFrwFs',
            ],
            1 => [
                'status' => 404,
            ],
        ]);

        $client->getProofOfDeliveries('cp', ['1', '4']);
    }

    public function testThrowsExceptionWhenNoReturnWithMultiplePackages(): void
    {
        $this->expectException(BadRequestException::class);

        $client = $this->newMockedClient(200, [
            'status' => 200,
        ]);

        $client->getProofOfDeliveries('cp', ['1', '2']);
    }

    public function testThrowsExceptionWhenNotAllDataReturnWithMultiplePackages(): void
    {
        $this->expectException(BadRequestException::class);

        $client = $this->newMockedClient(200, [
            'status' => 200,
            0        => [
                'status_id'   => 1,
                'status_text' => 'Zásilka byla doručena příjemci.',
            ],
        ]);

        $client->getProofOfDeliveries('cp', ['1', '2']);
    }

    public function testMakeRequestWithMultiplePackages(): void
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

        $client->getProofOfDeliveries('cp', ['1', '6']);

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

    public function testDataAreReturnedInFormatWithMultiplePackages(): void
    {
        $client = $this->newMockedClient(200, [
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

        $links = $client->getProofOfDeliveries('cp', ['1', '6', '5']);

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
