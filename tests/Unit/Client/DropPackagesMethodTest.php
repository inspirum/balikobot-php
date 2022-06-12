<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Client;

use Inspirum\Balikobot\Exceptions\BadRequestException;
use Inspirum\Balikobot\Services\Client;
use Inspirum\Balikobot\Services\Requester;

class DropPackagesMethodTest extends AbstractClientTestCase
{
    public function testDropPackagesIsProxyToDropPackageMethod(): void
    {
        $client = $this->createPartialMock(Client::class, ['dropPackages']);

        $client->expects(self::once())->method('dropPackages')->with('cp', ['1']);

        $client->dropPackage('cp', '1');

        self::assertTrue(true);
    }

    public function testThrowsExceptionOnError(): void
    {
        $this->expectException(BadRequestException::class);

        $client = $this->newMockedClient(400, [
            'status' => 200,
        ]);

        $client->dropPackages('cp', ['1']);
    }

    public function testThrowsExceptionOnBadStatusCode(): void
    {
        $this->expectException(BadRequestException::class);

        $client = $this->newMockedClient(200, [
            'status' => 400,
        ]);

        $client->dropPackages('cp', ['2']);
    }

    public function testRequestShouldHaveStatus(): void
    {
        $this->expectException(BadRequestException::class);

        $client = $this->newMockedClient(200, []);

        $client->dropPackages('cp', ['3']);
    }

    public function testMakeRequest(): void
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status' => 200,
        ], ['https://apiv2.balikobot.cz/cp/drop', ['package_ids' => ['1', '4', '876']]]);

        $client = new Client($requester);

        $client->dropPackages('cp', ['1', '4', '876']);

        self::assertTrue(true);
    }

    public function testDoesNotMakeRequestWithNoData(): void
    {
        $requester = $this->createMock(Requester::class);
        $requester->expects(self::never())->method('request');

        $client = new Client($requester);

        $client->dropPackages('cp', []);

        self::assertTrue(true);
    }
}
