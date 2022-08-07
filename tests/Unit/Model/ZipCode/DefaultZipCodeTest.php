<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Model\ZipCode;

use Inspirum\Balikobot\Definitions\Carrier;
use Inspirum\Balikobot\Definitions\Service;
use Inspirum\Balikobot\Model\ZipCode\DefaultZipCode;
use Inspirum\Balikobot\Tests\Unit\BaseTestCase;

final class DefaultZipCodeTest extends BaseTestCase
{
    public function testModel(): void
    {
        $carrier       = Carrier::CP;
        $service       = Service::CP_NP;
        $model         = new DefaultZipCode(
            $carrier,
            $service,
            '35002',
            null,
            'Praha',
            'CZ',
            false,
        );
        $expectedArray = [
            'carrier'         => 'cp',
            'service'         => 'NP',
            'zipCode'         => '35002',
            'zipCodeEnt'      => null,
            'city'            => 'Praha',
            'country'         => 'CZ',
            'morningDelivery' => false,
        ];

        self::assertSame($carrier, $model->getCarrier());
        self::assertSame($service, $model->getService());
        self::assertSame('35002', $model->getZipCode());
        self::assertSame(null, $model->getZipCodeEnd());
        self::assertSame('Praha', $model->getCity());
        self::assertSame('CZ', $model->getCountry());
        self::assertSame(false, $model->isMorningDelivery());
        self::assertSame($expectedArray, $model->__toArray());
    }
}
