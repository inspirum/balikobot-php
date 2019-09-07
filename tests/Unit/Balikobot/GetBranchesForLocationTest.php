<?php

namespace Inspirum\Balikobot\Tests\Unit\Balikobot;

use Generator;
use Inspirum\Balikobot\Model\Values\Branch;
use Inspirum\Balikobot\Services\Balikobot;

class GetBranchesForLocationTest extends AbstractBalikobotTestCase
{
    public function testMakeRequest()
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status'   => 200,
            'branches' => [],
        ]);

        $service = new Balikobot($requester);

        $branches = $service->getBranchesForLocation('ups', 'CZ', 'Praha', null, 'Pražská', 4, 40.3);

        $branches->valid();

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

    public function testMakeRequestWithTypeParameter()
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status'   => 200,
            'branches' => [],
        ]);

        $service = new Balikobot($requester);

        $branches = $service->getBranchesForLocation(
            'pbh',
            'DE',
            'Berlin',
            null,
            'Schönwalder',
            null,
            null,
            'postfiliale'
        );

        $branches->valid();

        $requester->shouldHaveReceived(
            'request',
            [
                'https://api.balikobot.cz/pbh/branchlocator',
                [
                    'country' => 'DE',
                    'city'    => 'Berlin',
                    'street'  => 'Schönwalder',
                    'type'    => 'postfiliale',
                ],
            ]
        );

        $this->assertTrue(true);
    }

    public function testResponseData()
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status'   => 200,
            'branches' => [
                [
                    'id'  => 1,
                    'zip' => '11000',
                ],
                [
                    'id'  => 876,
                    'zip' => '12000',
                ],
            ],
        ]);

        $service = new Balikobot($requester);

        $branches = $service->getBranchesForLocation('ups', 'CZ', 'Praha', null, 'Pražská', 4, 40.3);

        $this->assertInstanceOf(Generator::class, $branches);

        /* @var \Inspirum\Balikobot\Model\Values\Branch $branch */
        $branch = $branches->current();

        $this->assertInstanceOf(Branch::class, $branch);
        $this->assertEquals('1', $branch->getId());

        $branches->next();
        $branch = $branches->current();

        $this->assertInstanceOf(Branch::class, $branch);
        $this->assertEquals('876', $branch->getId());

        $branches->next();
        $branch = $branches->current();

        $this->assertEquals(null, $branch);
    }
}
