<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Client;

use Inspirum\Balikobot\Exceptions\BadRequestException;
use Inspirum\Balikobot\Services\Client;

class CheckPackagesMethodTest extends AbstractClientTestCase
{
    public function testThrowsExceptionOnError(): void
    {
        $this->expectException(BadRequestException::class);

        $client = $this->newMockedClient(400, [
            'status' => 200,
        ]);

        $client->checkPackages('cp', [['eid' => 1]]);
    }

    public function testRequestShouldHaveStatus(): void
    {
        $this->expectException(BadRequestException::class);

        $client = $this->newMockedClient(200, []);

        $client->checkPackages('cp', [['eid' => 1]]);
    }

    public function testThrowsExceptionOnBadStatusCode(): void
    {
        $this->expectException(BadRequestException::class);

        $client = $this->newMockedClient(200, [
            'status' => 400,
        ]);

        $client->checkPackages('cp', [['eid' => 1]]);
    }

    public function testMakeRequest(): void
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status' => 200,
        ], [
            'https://apiv2.balikobot.cz/cp/check',
            [
                'packages' => [
                    [
                        'data' => [1, 2, 3],
                        'test' => false,
                    ],
                ],
            ],
        ]);

        $client = new Client($requester);

        $client->checkPackages('cp', [['data' => [1, 2, 3], 'test' => false]]);

        self::assertTrue(true);
    }
}
