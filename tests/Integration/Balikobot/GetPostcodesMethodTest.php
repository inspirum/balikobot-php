<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Integration\Balikobot;

use Inspirum\Balikobot\Definitions\ServiceType;
use Inspirum\Balikobot\Definitions\Shipper;
use Inspirum\Balikobot\Model\Values\PostCode;

class GetPostcodesMethodTest extends AbstractBalikobotTestCase
{
    public function testValidRequest(): void
    {
        $service = $this->newBalikobot();

        $postCodes = $service->getPostCodes(Shipper::CP, ServiceType::CP_NB);

        /** @var \Inspirum\Balikobot\Model\Values\PostCode $postCode */
        $postCode = $postCodes->current();

        $this->assertInstanceOf(PostCode::class, $postCode);
        $this->assertNotEmpty($postCode->getPostcode());
    }

    public function testInvalidRequest(): void
    {
        $service = $this->newBalikobot();

        $branches = $service->getBranchesForShipperService(Shipper::TOPTRANS, ServiceType::TOPTRANS_NOTICE);
        $branches->valid();
        $this->assertNull($branches->current());
    }
}
