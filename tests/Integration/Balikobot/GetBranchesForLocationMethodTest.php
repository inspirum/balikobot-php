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
            Shipper::UPS,
            Country::CZECH_REPUBLIC,
            'Praha',
            null,
            'Pražská',
            4,
            40.3
        );

        /** @var \Inspirum\Balikobot\Model\Values\Branch $branch */
        $branch = $branches->current();

        $this->assertInstanceOf(Branch::class, $branch);
        $this->assertNotEmpty($branch->getId());
    }

    public function testInvalidRequest(): void
    {
        $service = $this->newBalikobot();

        try {
            $branches = $service->getBranchesForLocation(Shipper::UPS, Country::GHANA, 'Praha');
            $branches->valid();
            $this->assertTrue(false, 'BRANCHLOCATOR request should thrown exception');
        } catch (ExceptionInterface $exception) {
            $this->assertEquals(404, $exception->getStatusCode());
        }
    }
}
