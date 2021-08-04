<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Client;

use Inspirum\Balikobot\Exceptions\BadRequestException;
use Inspirum\Balikobot\Services\Client;

class GetOverviewMethodTest extends AbstractClientTestCase
{
    public function testThrowsExceptionOnError(): void
    {
        $this->expectException(BadRequestException::class);

        $client = $this->newMockedClient(400, [
            'status' => 200,
        ]);

        $client->getOverview('cp');
    }

    public function testRequestDoesNotHaveStatus(): void
    {
        $client = $this->newMockedClient(200, [
            'packages' => [
                [
                    'eid' => 29,
                ],
            ],
        ]);

        $order = $client->getOverview('cp');

        $this->assertNotEmpty($order);
    }

    public function testThrowsExceptionOnBadStatusCode(): void
    {
        $this->expectException(BadRequestException::class);

        $client = $this->newMockedClient(200, [
            'status' => 400,
        ]);

        $client->getOverview('cp');
    }

    public function testMakeRequest(): void
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, []);

        $client = new Client($requester);

        $client->getOverview('cp');

        $requester->shouldHaveReceived(
            'request',
            ['https://apiv2.balikobot.cz/cp/overview', []]
        );

        $this->assertTrue(true);
    }
}
