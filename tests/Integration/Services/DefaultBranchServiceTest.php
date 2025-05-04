<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Integration\Service;

use Inspirum\Balikobot\Definitions\Carrier;
use Inspirum\Balikobot\Definitions\Country;
use Inspirum\Balikobot\Definitions\Service;
use Inspirum\Balikobot\Exception\Exception;
use Inspirum\Balikobot\Tests\Integration\BaseTestCase;

final class DefaultBranchServiceTest extends BaseTestCase
{
    public function testGetBranchesForCarrierService(): void
    {
        $branchService = $this->newDefaultBranchService();

        $branches = $branchService->getBranchesForCarrierService(Carrier::CP, Service::CP_NB);

        $branches->next();
        self::assertTrue($branches->valid());
        self::assertNotNull($branches->current());

        $branches = $branchService->getBranchesForCarrierService(Carrier::CP, Service::CP_BB);

        $branches->next();
        self::assertFalse($branches->valid());
        self::assertNull($branches->current());
    }

    public function testGetBranchesForLocation(): void
    {
        $branchService = $this->newDefaultBranchService();

        $branches = $branchService->getBranchesForLocation(
            Carrier::PBH,
            Country::GERMANY,
            'Berlin',
            '10787',
            'Hardenbergplatz 8',
            4,
            40.3,
        );

        $branches->next();
        self::assertTrue($branches->valid());
        self::assertNotNull($branches->current());
    }

    public function testGetBranchesForLocationForInvalidData(): void
    {
        $branchService = $this->newDefaultBranchService();

        try {
            $branchService->getBranchesForLocation(
                Carrier::PBH,
                Country::GHANA,
                'Praha',
            );
            self::fail('BRANCHLOCATOR request should thrown exception');
        } catch (Exception $exception) {
            self::assertEquals(413, $exception->getStatusCode());
        }
    }
}
