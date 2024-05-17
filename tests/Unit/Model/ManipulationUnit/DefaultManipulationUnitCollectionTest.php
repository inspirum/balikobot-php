<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Model\ManipulationUnit;

use Inspirum\Balikobot\Model\ManipulationUnit\DefaultManipulationUnit;
use Inspirum\Balikobot\Model\ManipulationUnit\DefaultManipulationUnitCollection;
use Inspirum\Balikobot\Tests\Unit\BaseTestCase;

final class DefaultManipulationUnitCollectionTest extends BaseTestCase
{
    public function testCollection(): void
    {
        $carrier = 'ppl';
        $items = [
            new DefaultManipulationUnit(
                '32',
                'Balík',
            ),
            new DefaultManipulationUnit(
                '33',
                'Bedna',
            ),
        ];
        $collection = new DefaultManipulationUnitCollection($carrier, $items);
        $expectedArray = [
            [
                'code' => '32',
                'name' => 'Balík',
            ],
            [
                'code' => '33',
                'name' => 'Bedna',
            ],
        ];

        self::assertSame($carrier, $collection->getCarrier());
        self::assertSame($items, $collection->getUnits());
        self::assertSame($expectedArray, $collection->__toArray());
    }
}
