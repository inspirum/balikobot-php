<?php

namespace Inspirum\Balikobot\Tests\Unit\Balikobot;

use Generator;
use Inspirum\Balikobot\Model\Values\Branch;
use Inspirum\Balikobot\Services\Balikobot;
use Inspirum\Balikobot\Services\Requester;
use Mockery;

class GetBranchesMethodTest extends AbstractBalikobotTestCase
{
    public function testGetBranchesForShipperServiceCallAllServicesWithCountries()
    {
        /* @var \Inspirum\Balikobot\Services\Balikobot|\Mockery\MockInterface $service */
        $service = Mockery::mock(
            Balikobot::class . '[getServices,getBranchesForShipperService]',
            [new Requester('test', 'test')]
        );

        $service->shouldReceive('getBranchesForShipperService')
                ->with('ppl', '1', 'DE')
                ->andReturnUsing(function () {
                    yield from $this->branchesGenerator(5, 'DE', 'ppl', '1');
                });
        $service->shouldReceive('getBranchesForShipperService')
                ->with('ppl', '1', 'CZ')
                ->andReturnUsing(function () {
                    yield from $this->branchesGenerator(1, null, 'ppl', '1');
                    yield from $this->branchesGenerator(2, 'CZ', 'ppl', '1');
                });
        $service->shouldReceive('getBranchesForShipperService')
                ->with('ppl', '1', 'SK')
                ->andReturnUsing(function () {
                    yield from $this->branchesGenerator(1, 'SK', 'ppl', '1');
                });

        $count = 0;
        foreach ($service->getBranchesForShipperServiceForCountries('ppl', '1', ['DE', 'CZ', 'SK']) as $branch) {
            $this->assertNotEmpty($branch->getZip());
            $count++;
        }

        $this->assertEquals(8, $count);
    }

    public function testGetBranchesForShipperServiceCallAllServicesWithCountriesWithoutAPISupport()
    {
        /* @var \Inspirum\Balikobot\Services\Balikobot|\Mockery\MockInterface $service */
        $service = Mockery::mock(
            Balikobot::class . '[getServices,getBranchesForShipperService]',
            [new Requester('test', 'test')]
        );

        $service->shouldReceive('getBranchesForShipperService')->with('cp', 'NP')->andReturnUsing(function () {
            yield from $this->branchesGenerator(2, 'DE', 'cp', 'NP');
            yield from $this->branchesGenerator(2, 'HU', 'cp', 'NP');
            yield from $this->branchesGenerator(2, 'CZ', 'cp', 'NP');
        });

        $count = 0;
        foreach ($service->getBranchesForShipperServiceForCountries('cp', 'NP', ['DE', 'CZ', 'SK']) as $branch) {
            $this->assertNotEmpty($branch->getZip());
            $count++;
        }

        $this->assertEquals(4, $count);
    }

    public function testGetBranchesForShipperCallWithCountriesWithoutAPISupport()
    {
        /* @var \Inspirum\Balikobot\Services\Balikobot|\Mockery\MockInterface $service */
        $service = Mockery::mock(
            Balikobot::class . '[getServices,getBranchesForShipperService]',
            [new Requester('test', 'test')]
        );

        $service->shouldReceive('getBranchesForShipperService')
                ->with('zasilkovna', null, 'DE')
                ->andReturnUsing(function () {
                    yield from $this->branchesGenerator(5, 'DE', 'zasilkovna', null);
                });
        $service->shouldReceive('getBranchesForShipperService')
                ->with('zasilkovna', null, 'CZ')
                ->andReturnUsing(function () {
                    yield from $this->branchesGenerator(1, null, 'zasilkovna', null);
                    yield from $this->branchesGenerator(2, 'CZ', 'zasilkovna', null);
                });
        $service->shouldReceive('getBranchesForShipperService')
                ->with('zasilkovna', null, 'SK')
                ->andReturnUsing(function () {
                    yield from $this->branchesGenerator(1, 'SK', 'zasilkovna', null);
                });

        $count = 0;
        foreach (
            $service->getBranchesForShipperServiceForCountries(
                'zasilkovna',
                null,
                ['DE', 'CZ', 'SK']
            ) as $branch
        ) {
            $this->assertNotEmpty($branch->getZip());
            $count++;
        }

        $this->assertEquals(8, $count);
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
            yield from $this->branchesGenerator(2, null, 'cp', 'NP');
        });
        $service->shouldReceive('getBranchesForShipperService')->with('cp', 'RR')->andReturnUsing(function () {
            yield from $this->branchesGenerator(3, null, 'cp', 'NP');
        });

        $count = 0;
        foreach ($service->getBranchesForShipper('cp') as $branch) {
            $this->assertNotEmpty($branch->getZip());
            $count++;
        }

        $this->assertEquals(5, $count);
    }

    public function testGetBranchesForShipperCallAllServicesWithCountries()
    {
        /* @var \Inspirum\Balikobot\Services\Balikobot|\Mockery\MockInterface $service */
        $service = Mockery::mock(
            Balikobot::class . '[getServices,getBranchesForShipperServiceForCountries]',
            [new Requester('test', 'test')]
        );

        $service->shouldReceive('getServices')->with('cp')->andReturn(['NP' => 'NP', 'RR' => 'RR']);
        $service->shouldReceive('getBranchesForShipperServiceForCountries')
                ->with('cp', 'NP', ['DE', 'SK'])
                ->andReturnUsing(function () {
                    yield from $this->branchesGenerator(2, null, 'cp', 'NP');
                });
        $service->shouldReceive('getBranchesForShipperServiceForCountries')
                ->with('cp', 'RR', ['DE', 'SK'])
                ->andReturnUsing(function () {
                    yield from $this->branchesGenerator(3, null, 'cp', 'NP');
                });

        $count = 0;
        foreach ($service->getBranchesForShipperForCountries('cp', ['DE', 'SK']) as $branch) {
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
        $service->shouldReceive('getBranchesForShipperService')
                ->with('zasilkovna', null)
                ->andReturnUsing(function () {
                    yield from $this->branchesGenerator(2, null, 'zasilkovna', null);
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
            yield from $this->branchesGenerator(0, null, 'cp', null);
        });
        $service->shouldReceive('getBranchesForShipper')->with('ppl')->andReturnUsing(function () {
            yield from $this->branchesGenerator(2, null, 'ppl', null);
        });

        $count = 0;
        foreach ($service->getBranches() as $branch) {
            $this->assertNotEmpty($branch->getZip());
            $count++;
        }

        $this->assertEquals(2, $count);
    }

    public function testGetBranchesCallAllShippersWithCountries()
    {
        /* @var \Inspirum\Balikobot\Services\Balikobot|\Mockery\MockInterface $service */
        $service = Mockery::mock(
            Balikobot::class . '[getShippers,getBranchesForShipperForCountries]',
            [new Requester('test', 'test')]
        );

        $service->shouldReceive('getShippers')->andReturn(['cp', 'ppl']);
        $service->shouldReceive('getBranchesForShipperForCountries')
                ->with('cp', ['SK', 'CZ'])
                ->andReturnUsing(function () {
                    yield from $this->branchesGenerator(1, null, 'cp', null);
                });
        $service->shouldReceive('getBranchesForShipperForCountries')
                ->with('ppl', ['SK', 'CZ'])
                ->andReturnUsing(function () {
                    yield from $this->branchesGenerator(2, null, 'ppl', null);
                });

        $count = 0;
        foreach ($service->getBranchesForCountries(['SK', 'CZ']) as $branch) {
            $this->assertNotEmpty($branch->getZip());
            $count++;
        }

        $this->assertEquals(3, $count);
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
                'https://apiv2.balikobot.cz/cp/fullbranches/service/NP',
                [],
            ]
        );

        $this->assertTrue(true);
    }

    public function testBranchesWithCountryMakeRequest()
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status'   => 200,
            'branches' => [],
        ]);

        $services = new Balikobot($requester);

        $branches = $services->getBranchesForShipperService('ppl', '1', 'DE');

        $branches->valid();

        $requester->shouldHaveReceived(
            'request',
            [
                'https://apiv2.balikobot.cz/ppl/branches/service/1/country/DE',
                [],
            ]
        );

        $this->assertTrue(true);
    }

    public function testResponseData()
    {
        $service = $this->newMockedBalikobot(200, [
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

    private function branchesGenerator(int $limit, ?string $country, string $shipper, ?string $service): iterable
    {
        for ($i = 0; $i < $limit; $i++) {
            yield Branch::newInstanceFromData($shipper, $service, [
                'zip'     => '11000',
                'country' => $country,
            ]);
        }
    }
}
