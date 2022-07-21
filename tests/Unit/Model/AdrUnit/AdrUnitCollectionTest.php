<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Model\AdrUnit;

use Inspirum\Balikobot\Model\AdrUnit\AdrUnit;
use Inspirum\Balikobot\Model\AdrUnit\AdrUnitCollection;
use Inspirum\Balikobot\Model\Carrier\Carrier;
use Inspirum\Balikobot\Tests\BaseTestCase;

final class AdrUnitCollectionTest extends BaseTestCase
{
    public function testCollection(): void
    {
        $carrier       = Carrier::from('ppl');
        $collection    = new AdrUnitCollection(
            $carrier,
            [
                new AdrUnit(
                    $carrier,
                    '299',
                    '432',
                    'PŘEDMĚTY PYROTECHNICKÉ pro technické účely',
                    '1',
                    null,
                    'E',
                    '4',
                ),
                new AdrUnit(
                    $carrier,
                    '377',
                    '1001',
                    'ACETYLÉN, ROZPUŠTĚNÝ',
                    '2',
                    'A',
                    null,
                    '2',
                ),
            ],
        );
        $expectedArray = [
            [
                'id'                => '299',
                'code'              => '432',
                'name'              => 'PŘEDMĚTY PYROTECHNICKÉ pro technické účely',
                'class'             => '1',
                'packaging'         => null,
                'tunnelCode'        => 'E',
                'transportCategory' => '4',
            ],
            [
                'id'                => '377',
                'code'              => '1001',
                'name'              => 'ACETYLÉN, ROZPUŠTĚNÝ',
                'class'             => '2',
                'packaging'         => 'A',
                'tunnelCode'        => null,
                'transportCategory' => '2',
            ],
        ];

        self::assertSame($carrier, $collection->getCarrier());
        self::assertSame($expectedArray, $collection->__toArray());
    }
}
