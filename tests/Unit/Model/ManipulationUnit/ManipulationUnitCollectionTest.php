<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Model\ManipulationUnit;

use Inspirum\Balikobot\Model\Carrier\Carrier;
use Inspirum\Balikobot\Model\ManipulationUnit\ManipulationUnit;
use Inspirum\Balikobot\Model\ManipulationUnit\ManipulationUnitCollection;
use Inspirum\Balikobot\Tests\BaseTestCase;

final class ManipulationUnitCollectionTest extends BaseTestCase
{
    public function testCollection(): void
    {
        $carrier       = Carrier::from('ppl');
        $collection    = new ManipulationUnitCollection(
            $carrier,
            [
                new ManipulationUnit(
                    '32',
                    'Balík',
                ),
                new ManipulationUnit(
                    '33',
                    'Bedna',
                ),
            ],
        );
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
        self::assertSame($expectedArray, $collection->__toArray());
    }
}
