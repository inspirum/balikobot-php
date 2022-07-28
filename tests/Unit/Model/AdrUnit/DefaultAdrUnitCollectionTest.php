<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Model\AdrUnit;

use Inspirum\Balikobot\Model\AdrUnit\DefaultAdrUnit;
use Inspirum\Balikobot\Model\AdrUnit\DefaultAdrUnitCollection;
use Inspirum\Balikobot\Tests\BaseTestCase;

final class DefaultAdrUnitCollectionTest extends BaseTestCase
{
    public function testCollection(): void
    {
        $carrier       = 'ppl';
        $items         = [
            new DefaultAdrUnit(
                $carrier,
                '299',
                '432',
                'PŘEDMĚTY PYROTECHNICKÉ pro technické účely',
                '1',
                null,
                'E',
                '4',
            ),
            new DefaultAdrUnit(
                $carrier,
                '377',
                '1001',
                'ACETYLÉN, ROZPUŠTĚNÝ',
                '2',
                'A',
                null,
                '2',
            ),
        ];
        $collection    = new DefaultAdrUnitCollection($carrier, $items);
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
        self::assertSame($items, $collection->getUnits());
        self::assertSame($expectedArray, $collection->__toArray());
    }
}
