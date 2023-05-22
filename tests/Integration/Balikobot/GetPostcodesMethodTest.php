<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Integration\Balikobot;

use Inspirum\Balikobot\Definitions\ServiceType;
use Inspirum\Balikobot\Definitions\Shipper;
use Inspirum\Balikobot\Exceptions\BadRequestException;
use Inspirum\Balikobot\Model\Values\PostCode;

class GetPostcodesMethodTest extends AbstractBalikobotTestCase
{
    public function testValidRequest(): void
    {
        $service = $this->newBalikobot();

        $postCodes = $service->getPostCodes(Shipper::CP, ServiceType::CP_NB);

        /** @var \Inspirum\Balikobot\Model\Values\PostCode $postCode */
        $postCode = $postCodes->current();

        self::assertInstanceOf(PostCode::class, $postCode);
        self::assertNotEmpty($postCode->getPostcode());
    }

    public function testInvalidRequest(): void
    {
        $this->expectException(BadRequestException::class);

        $service = $this->newBalikobot();

        $branches = $service->getBranchesForShipperService(Shipper::CP, ServiceType::CP_BA);
        $branches->valid();
    }
}
