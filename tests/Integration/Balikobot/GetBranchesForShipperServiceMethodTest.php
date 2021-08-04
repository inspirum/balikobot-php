<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Integration\Balikobot;

use Inspirum\Balikobot\Definitions\ServiceType;
use Inspirum\Balikobot\Definitions\Shipper;
use Inspirum\Balikobot\Model\Values\Branch;

class GetBranchesForShipperServiceMethodTest extends AbstractBalikobotTestCase
{
    public function testValidRequest(): void
    {
        $service = $this->newBalikobot();

        $branches = $service->getBranchesForShipperService(Shipper::CP, ServiceType::CP_NB);

        /** @var \Inspirum\Balikobot\Model\Values\Branch $branch */
        $branch = $branches->current();

        $this->assertInstanceOf(Branch::class, $branch);
        $this->assertNotEmpty($branch->getId());
    }

    public function testInvalidRequest(): void
    {
        $service = $this->newBalikobot();

        $branches = $service->getBranchesForShipperService(Shipper::TOPTRANS, ServiceType::TOPTRANS_NOTICE);
        $branches->valid();
        $this->assertNull($branches->current());
    }
}
