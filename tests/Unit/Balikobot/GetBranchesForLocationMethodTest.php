<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Balikobot;

use Generator;
use Inspirum\Balikobot\Model\Values\Branch;
use Inspirum\Balikobot\Services\Balikobot;

class GetBranchesForLocationMethodTest extends AbstractBalikobotTestCase
{
    public function testMakeRequest(): void
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

        self::assertTrue(true);
    }

    public function testMakeRequestWithTypeParameter(): void
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
                'https://apiv2.balikobot.cz/pbh/branchlocator',
                [
                    'country' => 'DE',
                    'city'    => 'Berlin',
                    'street'  => 'Schönwalder',
                    'type'    => 'postfiliale',
                ],
            ]
        );

        self::assertTrue(true);
    }

    public function testResponseData(): void
    {
        $service = $this->newMockedBalikobot(200, [
            'status'   => 200,
            'branches' => [
                [
                    'id'  => '1',
                    'zip' => '11000',
                ],
                [
                    'id'  => '876',
                    'zip' => '12000',
                ],
            ],
        ]);

        $branches = $service->getBranchesForLocation('ups', 'CZ', 'Praha', null, 'Pražská', 4, 40.3);

        self::assertInstanceOf(Generator::class, $branches);

        /** @var \Inspirum\Balikobot\Model\Values\Branch $branch */
        $branch = $branches->current();

        self::assertInstanceOf(Branch::class, $branch);
        self::assertEquals('1', $branch->getId());

        $branches->next();
        $branch = $branches->current();

        self::assertInstanceOf(Branch::class, $branch);
        self::assertEquals('876', $branch->getId());

        $branches->next();
        $branch = $branches->current();

        self::assertEquals(null, $branch);
    }
}
