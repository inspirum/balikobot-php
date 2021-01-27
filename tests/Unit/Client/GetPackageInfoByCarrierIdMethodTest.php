<?php

namespace Inspirum\Balikobot\Tests\Unit\Client;

use Inspirum\Balikobot\Exceptions\BadRequestException;
use Inspirum\Balikobot\Services\Client;

class GetPackageInfoByCarrierIdMethodTest extends AbstractClientTestCase
{
    public function testThrowsExceptionOnError()
    {
        $this->expectException(BadRequestException::class);

        $client = $this->newMockedClient(400, [
            'status' => 200,
        ]);

        $client->getPackageInfoByCarrierId('cp', 'N0123');
    }

    public function testRequestDoesNotHaveStatus()
    {
        $client = $this->newMockedClient(200, [
            'data' => 1,
        ]);

        $status = $client->getPackageInfoByCarrierId('cp', 'N0123');

        $this->assertNotEmpty($status);
    }

    public function testThrowsExceptionOnBadStatusCode()
    {
        $this->expectException(BadRequestException::class);

        $client = $this->newMockedClient(200, [
            'status' => 400,
        ]);

        $client->getPackageInfoByCarrierId('cp', 'N0123');
    }

    public function testMakeRequest()
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status' => 200,
        ]);

        $client = new Client($requester);

        $client->getPackageInfoByCarrierId('cp', 'N0123');

        $requester->shouldHaveReceived(
            'request',
            [
                'https://apiv2.balikobot.cz/cp/package/carrier_id/N0123',
                [],
            ]
        );

        $this->assertTrue(true);
    }
}
