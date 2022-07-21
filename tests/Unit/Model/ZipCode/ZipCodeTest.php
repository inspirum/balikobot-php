<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Model\ZipCode;

use Inspirum\Balikobot\Model\Carrier\Carrier;
use Inspirum\Balikobot\Model\Service\Service;
use Inspirum\Balikobot\Model\ZipCode\ZipCode;
use Inspirum\Balikobot\Tests\BaseTestCase;

final class ZipCodeTest extends BaseTestCase
{
    public function testModel(): void
    {
        $carrier       = Carrier::from('cp');
        $service       = Service::from('NP');
        $model         = new ZipCode(
            $carrier,
            $service,
            '35002',
            null,
            null,
            'CZ',
            false,
        );
        $expectedArray = [
            'carrier'         => 'cp',
            'service'         => 'NP',
            'zipCode'         => '35002',
            'zipCodeEnt'      => null,
            'city'            => null,
            'country'         => 'CZ',
            'morningDelivery' => false,
        ];

        self::assertSame($expectedArray, $model->__toArray());
    }
}
