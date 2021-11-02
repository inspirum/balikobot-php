<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Client;

use Inspirum\Balikobot\Exceptions\BadRequestException;
use Inspirum\Balikobot\Services\Client;

class GetBranchesMethodTest extends AbstractClientTestCase
{
    public function testThrowsExceptionOnError(): void
    {
        $this->expectException(BadRequestException::class);

        $client = $this->newMockedClient(400, [
            'status' => 200,
        ]);

        $client->getBranches('cp', 'NP');
    }

    public function testRequestShouldHaveStatus(): void
    {
        $this->expectException(BadRequestException::class);

        $client = $this->newMockedClient(200, []);

        $client->getBranches('cp', 'NP');
    }

    public function testThrowsExceptionOnBadStatusCode(): void
    {
        $this->expectException(BadRequestException::class);

        $client = $this->newMockedClient(200, [
            'status' => 400,
        ]);

        $client->getBranches('cp', 'NP');
    }

    public function testMakeRequest(): void
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

        self::assertTrue(true);
    }

    public function testMakeRequestWithService(): void
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

        self::assertTrue(true);
    }

    public function testMakeRequestFullbranches(): void
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status'   => 200,
            'branches' => [],
        ]);

        $client = new Client($requester);

        $client->getBranches('cp', 'NP', fullBranchesRequest: true);

        $requester->shouldHaveReceived(
            'request',
            ['https://apiv2.balikobot.cz/cp/fullbranches/service/NP', []]
        );

        self::assertTrue(true);
    }

    public function testMakeRequestWithCountry(): void
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status'   => 200,
            'branches' => [],
        ]);

        $client = new Client($requester);

        $client->getBranches('cp', 'NP', 'DE');

        $requester->shouldHaveReceived(
            'request',
            ['https://apiv2.balikobot.cz/cp/branches/service/NP/country/DE', []]
        );

        self::assertTrue(true);
    }

    public function testMakeRequestWithCountryWithoutService(): void
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status'   => 200,
            'branches' => [],
        ]);

        $client = new Client($requester);

        $client->getBranches('zasilkovna', null, 'DE');

        $requester->shouldHaveReceived(
            'request',
            ['https://apiv2.balikobot.cz/zasilkovna/branches/country/DE', []]
        );

        self::assertTrue(true);
    }

    public function testMakeRequestCompressed(): void
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status'   => 200,
            'branches' => [],
        ]);

        $client = new Client($requester);

        $client->getBranches('cp', 'NP', gzip: true);

        $requester->shouldHaveReceived(
            'request',
            ['https://apiv2.balikobot.cz/cp/branches/service/NP?gzip=1', []]
        );

        self::assertTrue(true);
    }

    public function testMakeRequestWithServiceCompressed(): void
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status'   => 200,
            'branches' => [],
        ]);

        $client = new Client($requester);

        $client->getBranches('cp', 'NP', gzip: true);

        $requester->shouldHaveReceived(
            'request',
            ['https://apiv2.balikobot.cz/cp/branches/service/NP?gzip=1', []]
        );

        self::assertTrue(true);
    }

    public function testMakeRequestFullbranchesCompressed(): void
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status'   => 200,
            'branches' => [],
        ]);

        $client = new Client($requester);

        $client->getBranches('cp', 'NP', fullBranchesRequest: true, gzip: true);

        $requester->shouldHaveReceived(
            'request',
            ['https://apiv2.balikobot.cz/cp/fullbranches/service/NP?gzip=1', []]
        );

        self::assertTrue(true);
    }

    public function testMakeRequestWithCountryCompressed(): void
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status'   => 200,
            'branches' => [],
        ]);

        $client = new Client($requester);

        $client->getBranches('cp', 'NP', 'DE', gzip: true);

        $requester->shouldHaveReceived(
            'request',
            ['https://apiv2.balikobot.cz/cp/branches/service/NP/country/DE?gzip=1', []]
        );

        self::assertTrue(true);
    }

    public function testMakeRequestWithCountryWithoutServiceCompressed(): void
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status'   => 200,
            'branches' => [],
        ]);

        $client = new Client($requester);

        $client->getBranches('zasilkovna', null, 'DE', gzip: true);

        $requester->shouldHaveReceived(
            'request',
            ['https://apiv2.balikobot.cz/zasilkovna/branches/country/DE?gzip=1', []]
        );

        self::assertTrue(true);
    }

    public function testEmptyArrayIsReturnedIfUnitsMissing(): void
    {
        $client = $this->newMockedClient(200, [
            'status'   => 200,
            'branches' => null,
        ]);

        $branches = $client->getBranches('cp', 'NP');

        self::assertEquals([], $branches);
    }

    public function testOnlyBranchesDataAreReturned(): void
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

        self::assertEquals(
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
