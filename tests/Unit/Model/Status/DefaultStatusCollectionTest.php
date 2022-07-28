<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Model\ManipulationUnit;

use Inspirum\Balikobot\Model\Status\DefaultStatus;
use Inspirum\Balikobot\Model\Status\DefaultStatusCollection;
use Inspirum\Balikobot\Tests\BaseTestCase;

final class DefaultStatusCollectionTest extends BaseTestCase
{
    public function testCollection(): void
    {
        $carrier       = 'cp';
        $items         =   [
            new DefaultStatus(
                $carrier,
                '1',
                1.2,
                'Zásilka byla doručena příjemci.',
                'Zásilka byla doručena příjemci.',
                'event',
                null,
            ),
            new DefaultStatus(
                $carrier,
                '2',
                2.2,
                'Zásilka je v přepravě.',
                'Zásilka je v přepravě.',
                'event',
                null,
            ),
        ];
        $collection    = new DefaultStatusCollection($carrier, $items);
        $expectedArray = [
            [
                'carrier'     => 'cp',
                'carrierId'   => '1',
                'id'          => 1.2,
                'name'        => 'Zásilka byla doručena příjemci.',
                'description' => 'Zásilka byla doručena příjemci.',
                'type'        => 'event',
                'date'        => null,
            ],
            [
                'carrier'     => 'cp',
                'carrierId'   => '2',
                'id'          => 2.2,
                'name'        => 'Zásilka je v přepravě.',
                'description' => 'Zásilka je v přepravě.',
                'type'        => 'event',
                'date'        => null,
            ],
        ];

        self::assertSame($carrier, $collection->getCarrier());
        self::assertSame($items, $collection->getStatuses());
        self::assertSame($expectedArray, $collection->__toArray());
    }
}
