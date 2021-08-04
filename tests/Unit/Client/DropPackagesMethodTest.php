<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Client;

use Inspirum\Balikobot\Exceptions\BadRequestException;
use Inspirum\Balikobot\Services\Client;
use Inspirum\Balikobot\Services\Requester;
use Mockery;

class DropPackagesMethodTest extends AbstractClientTestCase
{
    public function testDropPackagesIsProxyToDropPackageMethod(): void
    {
        /** @var \Inspirum\Balikobot\Services\Client|\Mockery\MockInterface $client */
        $client = Mockery::mock(Client::class . '[dropPackages]', [new Requester('test', 'test')]);

        $client->shouldReceive('dropPackages')->with('cp', ['1'])->once()->andReturns();

        $client->dropPackage('cp', '1');

        $this->assertTrue(true);
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
        ]);

        $client = new Client($requester);

        $client->dropPackages('cp', ['1', '4', '876']);

        $requester->shouldHaveReceived(
            'request',
            ['https://apiv2.balikobot.cz/cp/drop', ['package_ids' => ['1', '4', '876']]]
        );

        $this->assertTrue(true);
    }

    public function testDoesNotMakeRequestWithNoData(): void
    {
        $requester = $this->newRequesterWithMockedRequestMethod(404, []);

        $client = new Client($requester);

        $client->dropPackages('cp', []);

        $requester->shouldNotHaveReceived('request');

        $this->assertTrue(true);
    }
}
