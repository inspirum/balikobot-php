<?php

namespace Inspirum\Balikobot\Tests\Unit\Client;

use Inspirum\Balikobot\Exceptions\BadRequestException;
use Inspirum\Balikobot\Services\Client;
use Inspirum\Balikobot\Tests\Unit\Client\AbstractClientTestCase;

class GetPackageInfoMethodTest extends AbstractClientTestCase
{
    public function testThrowsExceptionOnError()
    {
        $this->expectException(BadRequestException::class);

        $client = $this->newMockedClient(400, [
            'status' => 200,
        ]);

        $client->getPackageInfo('cp', 1);
    }

    public function testRequestDoesNotHaveStatus()
    {
        $client = $this->newMockedClient(200, [
            'data' => 1,
        ]);

        $status = $client->getPackageInfo('cp', 1);

        $this->assertNotEmpty($status);
    }

    public function testThrowsExceptionOnBadStatusCode()
    {
        $this->expectException(BadRequestException::class);

        $client = $this->newMockedClient(200, [
            'status' => 400,
        ]);

        $client->getPackageInfo('cp', 1);
    }

    public function testMakeRequest()
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status' => 200,
        ]);

        $client = new Client($requester);

        $client->getPackageInfo('cp', 1);

        $requester->shouldHaveReceived(
            'request',
            [
                'https://apiv2.balikobot.cz/cp/package/1',
                [],
            ]
        );

        $this->assertTrue(true);
    }
}
