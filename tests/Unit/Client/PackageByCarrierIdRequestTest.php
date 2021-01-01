<?php

namespace Inspirum\Balikobot\Tests\Unit\Client;

use Inspirum\Balikobot\Exceptions\BadRequestException;
use Inspirum\Balikobot\Services\Client;
use Inspirum\Balikobot\Tests\Unit\Client\AbstractClientTestCase;

class PackageByCarrierIdRequestTest extends AbstractClientTestCase
{
    public function testThrowsExceptionOnError()
    {
        $this->expectException(BadRequestException::class);

        $requester = $this->newRequesterWithMockedRequestMethod(400, [
            'status' => 200,
        ]);

        $client = new Client($requester);

        $client->getPackageInfoByCarrierId('cp', 'N0123');
    }

    public function testRequestDoesNotHaveStatus()
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'data' => 1,
        ]);

        $client = new Client($requester);

        $status = $client->getPackageInfoByCarrierId('cp', 'N0123');

        $this->assertNotEmpty($status);
    }

    public function testThrowsExceptionOnBadStatusCode()
    {
        $this->expectException(BadRequestException::class);

        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status' => 400,
        ]);

        $client = new Client($requester);

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
                'https://api.balikobot.cz/cp/package/carrier_id/N0123',
                [],
            ]
        );

        $this->assertTrue(true);
    }
}
