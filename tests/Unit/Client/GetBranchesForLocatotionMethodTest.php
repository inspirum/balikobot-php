<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Client;

use Inspirum\Balikobot\Exceptions\BadRequestException;
use Inspirum\Balikobot\Services\Client;

class GetBranchesForLocatotionMethodTest extends AbstractClientTestCase
{
    public function testThrowsExceptionOnError(): void
    {
        $this->expectException(BadRequestException::class);

        $client = $this->newMockedClient(400, [
            'status' => 200,
        ]);

        $client->getBranchesForLocation('ups', 'CZ', 'Praha');
    }

    public function testRequestShouldHaveStatus(): void
    {
        $this->expectException(BadRequestException::class);

        $client = $this->newMockedClient(200, []);

        $client->getBranchesForLocation('ups', 'CZ', 'Praha');
    }

    public function testThrowsExceptionOnBadStatusCode(): void
    {
        $this->expectException(BadRequestException::class);

        $client = $this->newMockedClient(200, [
            'status' => 400,
        ]);

        $client->getBranchesForLocation('ups', 'CZ', 'Praha');
    }

    public function testMakeRequest(): void
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status'   => 200,
            'branches' => [],
        ]);

        $client = new Client($requester);

        $client->getBranchesForLocation('ups', 'CZ', 'Praha', street: 'Pražská', maxResults: 4, radius: 40.3);

        $requester->shouldHaveReceived(
            'request',
            [
                'https://apiv2.balikobot.cz/ups/branchlocator',
                [
                    'country'     => 'CZ',
                    'city'        => 'Praha',
                    'street'      => 'Pražská',
                    'max_results' => 4,
                    'radius'      => 40.3,
                ],
            ]
        );

        $this->assertTrue(true);
    }

    public function testEmptyArrayIsReturnedIfUnitsMissing(): void
    {
        $client = $this->newMockedClient(200, [
            'status'   => 200,
            'branches' => null,
        ]);

        $branches = $client->getBranchesForLocation('ups', 'CZ', 'Praha');

        $this->assertEquals([], $branches);
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

        $branches = $client->getBranchesForLocation('ups', 'CZ', 'Praha');

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
