<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Client;

use Inspirum\Balikobot\Exceptions\BadRequestException;
use Inspirum\Balikobot\Services\Client;

class GetPackageInfoByCarrierIdMethodTest extends AbstractClientTestCase
{
    public function testThrowsExceptionOnError(): void
    {
        $this->expectException(BadRequestException::class);

        $client = $this->newMockedClient(400, [
            'status' => 200,
        ]);

        $client->getPackageInfoByCarrierId('cp', 'N0123');
    }

    public function testRequestDoesNotHaveStatus(): void
    {
        $client = $this->newMockedClient(200, [
            'data' => 1,
        ]);

        $status = $client->getPackageInfoByCarrierId('cp', 'N0123');

        self::assertNotEmpty($status);
    }

    public function testThrowsExceptionOnBadStatusCode(): void
    {
        $this->expectException(BadRequestException::class);

        $client = $this->newMockedClient(200, [
            'status' => 400,
        ]);

        $client->getPackageInfoByCarrierId('cp', 'N0123');
    }

    public function testMakeRequest(): void
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status' => 200,
        ], [
            'https://apiv2.balikobot.cz/cp/package/carrier_id/N0123',
            [],
        ]);

        $client = new Client($requester);

        $client->getPackageInfoByCarrierId('cp', 'N0123');

        self::assertTrue(true);
    }
}
