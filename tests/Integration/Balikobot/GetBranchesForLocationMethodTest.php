<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Integration\Balikobot;

use Inspirum\Balikobot\Contracts\ExceptionInterface;
use Inspirum\Balikobot\Definitions\Country;
use Inspirum\Balikobot\Definitions\Shipper;
use Inspirum\Balikobot\Model\Values\Branch;

class GetBranchesForLocationMethodTest extends AbstractBalikobotTestCase
{
    public function testValidRequest(): void
    {
        $service = $this->newBalikobot();

        $branches = $service->getBranchesForLocation(
            Shipper::PBH,
            Country::GERMANY,
            'Berlin',
            null,
            'Berlin',
            4,
            40.3,
        );

        /** @var \Inspirum\Balikobot\Model\Values\Branch $branch */
        $branch = $branches->current();

        self::assertInstanceOf(Branch::class, $branch);
        self::assertNotEmpty($branch->getId());
    }

    public function testInvalidRequest(): void
    {
        $service = $this->newBalikobot();

        try {
            $branches = $service->getBranchesForLocation(Shipper::PBH, Country::GHANA, 'Praha');
            $branches->valid();
            self::fail('BRANCHLOCATOR request should thrown exception');
        } catch (ExceptionInterface $exception) {
            self::assertEquals(413, $exception->getStatusCode());
        }
    }
}
