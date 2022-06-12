<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Balikobot;

use Generator;
use Inspirum\Balikobot\Model\Values\Branch;
use Inspirum\Balikobot\Services\Balikobot;
use PHPUnit\Framework\MockObject\Stub\ReturnCallback;

class GetBranchesMethodTest extends AbstractBalikobotTestCase
{
    public function testGetBranchesForShipperServiceCallAllServicesWithCountries(): void
    {
        $service = $this->createPartialMock(Balikobot::class, ['getServices', 'getBranchesForShipperService']);

        $service->expects(self::exactly(3))->method('getBranchesForShipperService')
                ->withConsecutive(
                    ['ppl', '1', 'DE'],
                    ['ppl', '1', 'CZ'],
                    ['ppl', '1', 'SK'],
                )
                ->willReturnOnConsecutiveCalls(
                    new ReturnCallback(function () {
                        yield from $this->branchesGenerator(5, 'DE', 'ppl', '1');
                    }),
                    new ReturnCallback(function () {
                        yield from $this->branchesGenerator(1, null, 'ppl', '1');
                        yield from $this->branchesGenerator(2, 'CZ', 'ppl', '1');
                    }),
                    new ReturnCallback(function () {
                        yield from $this->branchesGenerator(1, 'SK', 'ppl', '1');
                    }),
                );

        $count = 0;
        foreach ($service->getBranchesForShipperServiceForCountries('ppl', '1', ['DE', 'CZ', 'SK']) as $branch) {
            self::assertNotEmpty($branch->getZip());
            $count++;
        }

        self::assertEquals(8, $count);
    }

    public function testGetBranchesForShipperServiceCallAllServicesWithCountriesWithoutAPISupport(): void
    {
        $service = $this->createPartialMock(Balikobot::class, ['getServices', 'getBranchesForShipperService']);

        $service->expects(self::exactly(1))->method('getBranchesForShipperService')
                ->withConsecutive(
                    ['cp', 'NP'],
                )
                ->willReturnOnConsecutiveCalls(
                    new ReturnCallback(function () {
                        yield from $this->branchesGenerator(2, 'DE', 'cp', 'NP');
                        yield from $this->branchesGenerator(2, 'HU', 'cp', 'NP');
                        yield from $this->branchesGenerator(2, 'CZ', 'cp', 'NP');
                    }),
                );

        $count = 0;
        foreach ($service->getBranchesForShipperServiceForCountries('cp', 'NP', ['DE', 'CZ', 'SK']) as $branch) {
            self::assertNotEmpty($branch->getZip());
            $count++;
        }

        self::assertEquals(4, $count);
    }

    public function testGetBranchesForShipperCallWithCountriesWithoutAPISupport(): void
    {
        $service = $this->createPartialMock(Balikobot::class, ['getServices', 'getBranchesForShipperService']);

        $service->expects(self::exactly(3))->method('getBranchesForShipperService')
                ->withConsecutive(
                    ['zasilkovna', null, 'DE'],
                    ['zasilkovna', null, 'CZ'],
                    ['zasilkovna', null, 'SK'],
                )
                ->willReturnOnConsecutiveCalls(
                    new ReturnCallback(function () {
                        yield from $this->branchesGenerator(5, 'DE', 'zasilkovna', null);
                    }),
                    new ReturnCallback(function () {
                        yield from $this->branchesGenerator(1, null, 'zasilkovna', null);
                        yield from $this->branchesGenerator(2, 'CZ', 'zasilkovna', null);
                    }),
                    new ReturnCallback(function () {
                        yield from $this->branchesGenerator(1, 'SK', 'zasilkovna', null);
                    }),
                );

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
        $service = $this->createPartialMock(Balikobot::class, ['getServices', 'getBranchesForShipperService']);

        $service->expects(self::once())->method('getServices')->with('cp')->willReturn(['NP' => 'NP', 'RR' => 'RR']);

        $service->expects(self::exactly(2))->method('getBranchesForShipperService')
                ->withConsecutive(
                    ['cp', 'NP'],
                    ['cp', 'RR'],
                )
                ->willReturnOnConsecutiveCalls(
                    new ReturnCallback(function () {
                        yield from $this->branchesGenerator(2, null, 'cp', 'NP');
                    }),
                    new ReturnCallback(function () {
                        yield from $this->branchesGenerator(3, null, 'cp', 'NP');
                    }),
                );

        $count = 0;
        foreach ($service->getBranchesForShipper('cp') as $branch) {
            self::assertNotEmpty($branch->getZip());
            $count++;
        }

        self::assertEquals(5, $count);
    }

    public function testGetBranchesForShipperCallAllServicesWithCountries(): void
    {
        $service = $this->createPartialMock(Balikobot::class, ['getServices', 'getBranchesForShipperServiceForCountries']);

        $service->expects(self::once())->method('getServices')->with('cp')->willReturn(['NP' => 'NP', 'RR' => 'RR']);

        $service->expects(self::exactly(2))->method('getBranchesForShipperServiceForCountries')
                ->withConsecutive(
                    ['cp', 'NP', ['DE', 'SK']],
                    ['cp', 'RR', ['DE', 'SK']],
                )
                ->willReturnOnConsecutiveCalls(
                    new ReturnCallback(function () {
                        yield from $this->branchesGenerator(2, null, 'cp', 'NP');
                    }),
                    new ReturnCallback(function () {
                        yield from $this->branchesGenerator(3, null, 'cp', 'NP');
                    }),
                );

        $count = 0;
        foreach ($service->getBranchesForShipperForCountries('cp', ['DE', 'SK']) as $branch) {
            self::assertNotEmpty($branch->getZip());
            $count++;
        }

        self::assertEquals(5, $count);
    }

    public function testGetBranchesForShipperCallForEmptyServices(): void
    {
        $service = $this->createPartialMock(Balikobot::class, ['getServices', 'getBranchesForShipperService']);

        $service->expects(self::once())->method('getServices')->with('zasilkovna')->willReturn([]);

        $service->expects(self::exactly(1))->method('getBranchesForShipperService')
                ->withConsecutive(
                    ['zasilkovna', null],
                )
                ->willReturnOnConsecutiveCalls(
                    new ReturnCallback(function () {
                        yield from $this->branchesGenerator(2, null, 'zasilkovna', null);
                    }),
                );

        $count = 0;
        foreach ($service->getBranchesForShipper('zasilkovna') as $branch) {
            self::assertNotEmpty($branch->getZip());
            $count++;
        }

        self::assertEquals(2, $count);
    }

    public function testGetBranchesCallAllShippers(): void
    {
        $service = $this->createPartialMock(Balikobot::class, ['getShippers', 'getBranchesForShipper']);

        $service->expects(self::once())->method('getShippers')->willReturn(['cp', 'ppl']);

        $service->expects(self::exactly(2))->method('getBranchesForShipper')
                ->withConsecutive(
                    ['cp'],
                    ['ppl'],
                )
                ->willReturnOnConsecutiveCalls(
                    new ReturnCallback(function () {
                        yield from $this->branchesGenerator(0, null, 'cp', null);
                    }),
                    new ReturnCallback(function () {
                        yield from $this->branchesGenerator(2, null, 'ppl', null);
                    }),
                );

        $count = 0;
        foreach ($service->getBranches() as $branch) {
            self::assertNotEmpty($branch->getZip());
            $count++;
        }

        self::assertEquals(2, $count);
    }

    public function testGetBranchesCallAllShippersWithCountries(): void
    {
        $service = $this->createPartialMock(Balikobot::class, ['getShippers', 'getBranchesForShipperForCountries']);

        $service->expects(self::once())->method('getShippers')->willReturn(['cp', 'ppl']);

        $service->expects(self::exactly(2))->method('getBranchesForShipperForCountries')
                ->withConsecutive(
                    ['cp', ['SK', 'CZ']],
                    ['ppl', ['SK', 'CZ']],
                )
                ->willReturnOnConsecutiveCalls(
                    new ReturnCallback(function () {
                        yield from $this->branchesGenerator(1, null, 'cp', null);
                    }),
                    new ReturnCallback(function () {
                        yield from $this->branchesGenerator(2, null, 'ppl', null);
                    }),
                );

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
        ], [
            'https://apiv2.balikobot.cz/cp/fullbranches/service/NP?gzip=1',
            [],
        ]);

        $services = new Balikobot($requester);

        $branches = $services->getBranchesForShipperService('cp', 'NP');

        $branches->valid();

        self::assertTrue(true);
    }

    public function testBranchesWithCountryMakeRequest(): void
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status'   => 200,
            'branches' => [],
        ], [
            'https://apiv2.balikobot.cz/ppl/branches/service/1/country/DE?gzip=1',
            [],
        ]);

        $services = new Balikobot($requester);

        $branches = $services->getBranchesForShipperService('ppl', '1', 'DE');

        $branches->valid();

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
