<?php

namespace Inspirum\Balikobot\Tests\Unit\Client;

use Inspirum\Balikobot\Exceptions\BadRequestException;
use Inspirum\Balikobot\Services\Client;
use Inspirum\Balikobot\Tests\Unit\Client\AbstractClientTestCase;

class GetBranchesMethodTest extends AbstractClientTestCase
{
    public function testThrowsExceptionOnError()
    {
        $this->expectException(BadRequestException::class);

        $client = $this->newMockedClient(400, [
            'status' => 200,
        ]);

        $client->getBranches('cp', 'NP');
    }

    public function testRequestShouldHaveStatus()
    {
        $this->expectException(BadRequestException::class);

        $client = $this->newMockedClient(200, []);

        $client->getBranches('cp', 'NP');
    }

    public function testThrowsExceptionOnBadStatusCode()
    {
        $this->expectException(BadRequestException::class);

        $client = $this->newMockedClient(200, [
            'status' => 400,
        ]);

        $client->getBranches('cp', 'NP');
    }

    public function testMakeRequest()
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status'   => 200,
            'branches' => [],
        ]);

        $client = new Client($requester);

        $client->getBranches('cp', 'NP');

        $requester->shouldHaveReceived(
            'request',
            ['https://apiv2.balikobot.cz/cp/branches/service/NP', []]
        );

        $this->assertTrue(true);
    }

    public function testMakeRequestWithService()
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status'   => 200,
            'branches' => [],
        ]);

        $client = new Client($requester);

        $client->getBranches('cp', 'NP');

        $requester->shouldHaveReceived(
            'request',
            ['https://apiv2.balikobot.cz/cp/branches/service/NP', []]
        );

        $this->assertTrue(true);
    }

    public function testMakeRequestFullbranches()
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status'   => 200,
            'branches' => [],
        ]);

        $client = new Client($requester);

        $client->getBranches('cp', 'NP', true);

        $requester->shouldHaveReceived(
            'request',
            ['https://apiv2.balikobot.cz/cp/fullbranches/service/NP', []]
        );

        $this->assertTrue(true);
    }

    public function testMakeRequestWithCountry()
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status'   => 200,
            'branches' => [],
        ]);

        $client = new Client($requester);

        $client->getBranches('cp', 'NP', false, 'DE');

        $requester->shouldHaveReceived(
            'request',
            ['https://apiv2.balikobot.cz/cp/branches/service/NP/country/DE', []]
        );

        $this->assertTrue(true);
    }

    public function testMakeRequestWithCountryWithoutService()
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status'   => 200,
            'branches' => [],
        ]);

        $client = new Client($requester);

        $client->getBranches('zasilkovna', null, false, 'DE');

        $requester->shouldHaveReceived(
            'request',
            ['https://apiv2.balikobot.cz/zasilkovna/branches/country/DE', []]
        );

        $this->assertTrue(true);
    }

    public function testEmptyArrayIsReturnedIfUnitsMissing()
    {
        $client = $this->newMockedClient(200, [
            'status'   => 200,
            'branches' => null,
        ]);

        $branches = $client->getBranches('cp', 'NP');

        $this->assertEquals([], $branches);
    }

    public function testOnlyBranchesDataAreReturned()
    {
        $client = $this->newMockedClient(200, [
            'status'   => 200,
            'branches' => [
                [
                    'code' => 1,
                    'name' => 'AAA',
                ],
                [
                    'code' => 876,
                    'name' => 'BBB',
                ],
            ],
        ]);

        $branches = $client->getBranches('cp', 'NP');

        $this->assertEquals(
            [
                [
                    'code' => 1,
                    'name' => 'AAA',
                ],
                [
                    'code' => 876,
                    'name' => 'BBB',
                ],
            ],
            $branches
        );
    }
}
