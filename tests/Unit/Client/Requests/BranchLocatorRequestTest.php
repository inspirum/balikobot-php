<?php

namespace Inspirum\Balikobot\Tests\Unit\Client\Requests;

use Inspirum\Balikobot\Exceptions\BadRequestException;
use Inspirum\Balikobot\Services\Client;
use Inspirum\Balikobot\Tests\Unit\Client\AbstractClientTestCase;

class BranchLocatorRequestTest extends AbstractClientTestCase
{
    public function testThrowsExceptionOnError()
    {
        $this->expectException(BadRequestException::class);

        $requester = $this->newRequesterWithMockedRequestMethod(400, [
            'status' => 200,
        ]);

        $client = new Client($requester);

        $client->getBranchesForLocation('ups', 'CZ', 'Praha');
    }

    public function testRequestShouldHaveStatus()
    {
        $this->expectException(BadRequestException::class);

        $requester = $this->newRequesterWithMockedRequestMethod(200, []);

        $client = new Client($requester);

        $client->getBranchesForLocation('ups', 'CZ', 'Praha');
    }

    public function testThrowsExceptionOnBadStatusCode()
    {
        $this->expectException(BadRequestException::class);

        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status' => 400,
        ]);

        $client = new Client($requester);

        $client->getBranchesForLocation('ups', 'CZ', 'Praha');
    }

    public function testMakeRequest()
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status'   => 200,
            'branches' => [],
        ]);

        $client = new Client($requester);

        $client->getBranchesForLocation('ups', 'CZ', 'Praha', null, 'Pražská', 4, 40.3);

        $requester->shouldHaveReceived(
            'request',
            [
                'https://api.balikobot.cz/ups/branchlocator',
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

    public function testEmptyArrayIsReturnedIfUnitsMissing()
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status'   => 200,
            'branches' => null,
        ]);

        $client = new Client($requester);

        $branches = $client->getBranchesForLocation('ups', 'CZ', 'Praha');

        $this->assertEquals([], $branches);
    }

    public function testOnlyBranchesDataAreReturned()
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
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

        $client = new Client($requester);

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
