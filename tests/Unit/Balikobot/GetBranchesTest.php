<?php

namespace Inspirum\Balikobot\Tests\Unit\Balikobot;

use Generator;
use Inspirum\Balikobot\Definitions\Shipper;
use Inspirum\Balikobot\Model\Values\Branch;
use Inspirum\Balikobot\Services\Balikobot;
use Inspirum\Balikobot\Services\Requester;
use Mockery;

class GetBranchesTest extends AbstractBalikobotTestCase
{
    public function testFullBranchesSupport()
    {
        $fullbranches = Shipper::hasFullBranchesSupport('cp', 'NP');

        $this->assertTrue($fullbranches);

        $fullbranches = Shipper::hasFullBranchesSupport('zasilkovna', null);

        $this->assertTrue($fullbranches);

        $fullbranches = Shipper::hasFullBranchesSupport('pbh', '6');

        $this->assertTrue($fullbranches);

        $fullbranches = Shipper::hasFullBranchesSupport('pbh', '15');

        $this->assertTrue($fullbranches);

        $fullbranches = Shipper::hasFullBranchesSupport('cp', 'RR');

        $this->assertFalse($fullbranches);

        $fullbranches = Shipper::hasFullBranchesSupport('ulozenka', null);

        $this->assertFalse($fullbranches);
    }

    public function testGetBranchesForShipperCallAllServices()
    {
        /* @var \Inspirum\Balikobot\Services\Balikobot|\Mockery\MockInterface $service */
        $service = Mockery::mock(
            Balikobot::class . '[getServices,getBranchesForShipperService]',
            [new Requester('test', 'test')]
        );

        $service->shouldReceive('getServices')->with('cp')->andReturn(['NP' => 'NP', 'RR' => 'RR']);
        $service->shouldReceive('getBranchesForShipperService')->with('cp', 'NP')->andReturnUsing(function () {
            yield from $this->branchesGenerator(2);
        });
        $service->shouldReceive('getBranchesForShipperService')->with('cp', 'RR')->andReturnUsing(function () {
            yield from $this->branchesGenerator(3);
        });

        $count = 0;
        foreach ($service->getBranchesForShipper('cp') as $branch) {
            $this->assertNotEmpty($branch->getZip());
            $count++;
        }

        $this->assertEquals(5, $count);
    }

    public function testGetBranchesForShipperCallForEmptyServices()
    {
        /* @var \Inspirum\Balikobot\Services\Balikobot|\Mockery\MockInterface $service */
        $service = Mockery::mock(
            Balikobot::class . '[getServices,getBranchesForShipperService]',
            [new Requester('test', 'test')]
        );

        $service->shouldReceive('getServices')->with('zasilkovna')->andReturn([]);
        $service->shouldReceive('getBranchesForShipperService')->with('zasilkovna', null)->andReturnUsing(function () {
            yield from $this->branchesGenerator(2);
        });

        $count = 0;
        foreach ($service->getBranchesForShipper('zasilkovna') as $branch) {
            $this->assertNotEmpty($branch->getZip());
            $count++;
        }

        $this->assertEquals(2, $count);
    }

    public function testGetBranchesCallAllShippers()
    {
        /* @var \Inspirum\Balikobot\Services\Balikobot|\Mockery\MockInterface $service */
        $service = Mockery::mock(
            Balikobot::class . '[getShippers,getBranchesForShipper]',
            [new Requester('test', 'test')]
        );

        $service->shouldReceive('getShippers')->andReturn(['cp', 'ppl']);
        $service->shouldReceive('getBranchesForShipper')->with('cp')->andReturnUsing(function () {
            yield from $this->branchesGenerator(0);
        });
        $service->shouldReceive('getBranchesForShipper')->with('ppl')->andReturnUsing(function () {
            yield from $this->branchesGenerator(2);
        });

        $count = 0;
        foreach ($service->getBranches() as $branch) {
            $this->assertNotEmpty($branch->getZip());
            $count++;
        }

        $this->assertEquals(2, $count);
    }

    private function branchesGenerator(int $limit): iterable
    {
        for ($i = 0; $i < $limit; $i++) {
            yield Branch::newInstanceFromData('cp', 'NP', [
                'zip' => '11000',
            ]);
        }
    }

    public function testFullBranchesMakeRequest()
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status'   => 200,
            'branches' => [],
        ]);

        $services = new Balikobot($requester);

        $branches = $services->getBranchesForShipperService('cp', 'NP');

        $branches->valid();

        $requester->shouldHaveReceived(
            'request',
            [
                'https://api.balikobot.cz/cp/fullbranches/NP',
                [],
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
                    'zip' => "11000",
                ],
                [
                    'id'  => 876,
                    'zip' => "12000",
                ],
            ],
        ]);

        $service = new Balikobot($requester);

        $branches = $service->getBranchesForShipperService('cp', 'NP');

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
