<?php

namespace Inspirum\Balikobot\Tests\Unit\Client;

use Inspirum\Balikobot\Exceptions\BadRequestException;
use Inspirum\Balikobot\Services\Client;
use Inspirum\Balikobot\Services\Requester;
use Inspirum\Balikobot\Tests\Unit\Client\AbstractClientTestCase;
use Mockery;

class DropRequestTest extends AbstractClientTestCase
{
    public function testDropPackagesIsProxyToDropPackageMethod()
    {
        /* @var \Inspirum\Balikobot\Services\Client|\Mockery\MockInterface $client */
        $client = Mockery::mock(Client::class . '[dropPackages]', [new Requester('test', 'test')]);

        $client->shouldReceive('dropPackages')->with('cp', [1])->once()->andReturns();

        $client->dropPackage('cp', 1);

        $this->assertTrue(true);
    }

    public function testThrowsExceptionOnError()
    {
        $this->expectException(BadRequestException::class);

        $requester = $this->newRequesterWithMockedRequestMethod(400, [
            'status' => 200,
        ]);

        $client = new Client($requester);

        $client->dropPackages('cp', [1]);
    }

    public function testThrowsExceptionOnBadStatusCode()
    {
        $this->expectException(BadRequestException::class);

        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status' => 400,
        ]);

        $client = new Client($requester);

        $client->dropPackages('cp', [2]);
    }

    public function testRequestShouldHaveStatus()
    {
        $this->expectException(BadRequestException::class);

        $requester = $this->newRequesterWithMockedRequestMethod(200, []);

        $client = new Client($requester);

        $client->dropPackages('cp', [3]);
    }

    public function testMakeRequest()
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status' => 200,
        ]);

        $client = new Client($requester);

        $client->dropPackages('cp', [1, 4, 876]);

        $requester->shouldHaveReceived(
            'request',
            ['https://apiv2.balikobot.cz/cp/drop', [['id' => 1], ['id' => 4], ['id' => 876]]]
        );

        $this->assertTrue(true);
    }

    public function testDoesNotMakeRequestWithNoData()
    {
        $requester = $this->newRequesterWithMockedRequestMethod(404, []);

        $client = new Client($requester);

        $client->dropPackages('cp', []);

        $requester->shouldNotHaveReceived('request');

        $this->assertTrue(true);
    }
}
