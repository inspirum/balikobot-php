<?php

namespace Inspirum\Balikobot\Tests\Integration\Balikobot;

use Inspirum\Balikobot\Definitions\ServiceType;
use Inspirum\Balikobot\Definitions\Shipper;
use Inspirum\Balikobot\Exceptions\BadRequestException;
use Inspirum\Balikobot\Model\Values\PostCode;

class GetPostcodesMethodTest extends AbstractBalikobotTestCase
{
    public function testValidRequest()
    {
        $service = $this->newBalikobot();

        $postCodes = $service->getPostCodes(Shipper::CP, ServiceType::CP_NB);

        /* @var \Inspirum\Balikobot\Model\Values\PostCode $postCode */
        $postCode = $postCodes->current();

        $this->assertInstanceOf(PostCode::class, $postCode);
        $this->assertNotEmpty($postCode->getPostcode());
    }

    public function testInvalidRequest()
    {
        $this->expectException(BadRequestException::class);

        $service = $this->newBalikobot();

        $branches = $service->getBranchesForShipperService(Shipper::TOPTRANS, ServiceType::TOPTRANS_NOTICE);
        $branches->valid();
    }
}
