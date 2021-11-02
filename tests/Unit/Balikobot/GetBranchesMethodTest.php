<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Balikobot;

use Generator;
use Inspirum\Balikobot\Model\Values\Branch;
use Inspirum\Balikobot\Services\Balikobot;
use Inspirum\Balikobot\Services\Requester;
use Mockery;

class GetBranchesMethodTest extends AbstractBalikobotTestCase
{
    public function testGetBranchesForShipperServiceCallAllServicesWithCountries(): void
    {
        /** @var \Inspirum\Balikobot\Services\Balikobot|\Mockery\MockInterface $service */
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
            self::assertNotEmpty($branch->getZip());
            $count++;
        }

        self::assertEquals(8, $count);
    }

    public function testGetBranchesForShipperServiceCallAllServicesWithCountriesWithoutAPISupport(): void
    {
        /** @var \Inspirum\Balikobot\Services\Balikobot|\Mockery\MockInterface $service */
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
            self::assertNotEmpty($branch->getZip());
            $count++;
        }

        self::assertEquals(4, $count);
    }

    public function testGetBranchesForShipperCallWithCountriesWithoutAPISupport(): void
    {
        /** @var \Inspirum\Balikobot\Services\Balikobot|\Mockery\MockInterface $service */
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
            self::assertNotEmpty($branch->getZip());
            $count++;
        }

        self::assertEquals(8, $count);
    }

    public function testGetBranchesForShipperCallAllServices(): void
    {
        /** @var \Inspirum\Balikobot\Services\Balikobot|\Mockery\MockInterface $service */
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
            self::assertNotEmpty($branch->getZip());
            $count++;
        }

        self::assertEquals(5, $count);
    }

    public function testGetBranchesForShipperCallAllServicesWithCountries(): void
    {
        /** @var \Inspirum\Balikobot\Services\Balikobot|\Mockery\MockInterface $service */
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
            self::assertNotEmpty($branch->getZip());
            $count++;
        }

        self::assertEquals(5, $count);
    }

    public function testGetBranchesForShipperCallForEmptyServices(): void
    {
        /** @var \Inspirum\Balikobot\Services\Balikobot|\Mockery\MockInterface $service */
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
            self::assertNotEmpty($branch->getZip());
            $count++;
        }

        self::assertEquals(2, $count);
    }

    public function testGetBranchesCallAllShippers(): void
    {
        /** @var \Inspirum\Balikobot\Services\Balikobot|\Mockery\MockInterface $service */
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
            self::assertNotEmpty($branch->getZip());
            $count++;
        }

        self::assertEquals(2, $count);
    }

    public function testGetBranchesCallAllShippersWithCountries(): void
    {
        /** @var \Inspirum\Balikobot\Services\Balikobot|\Mockery\MockInterface $service */
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
            self::assertNotEmpty($branch->getZip());
            $count++;
        }

        self::assertEquals(3, $count);
    }

    public function testFullBranchesMakeRequest(): void
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
                'https://apiv2.balikobot.cz/cp/fullbranches/service/NP?gzip=1',
                [],
            ]
        );

        self::assertTrue(true);
    }

    public function testBranchesWithCountryMakeRequest(): void
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
                'https://apiv2.balikobot.cz/ppl/branches/service/1/country/DE?gzip=1',
                [],
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

        $branches = $service->getBranchesForShipperService('cp', 'NP');

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

    /**
     * @param int         $limit
     * @param string|null $country
     * @param string      $shipper
     * @param string|null $service
     *
     * @return iterable<\Inspirum\Balikobot\Model\Values\Branch>
     */
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
