<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Model\ManipulationUnit;

use Inspirum\Balikobot\Model\Carrier\Carrier;
use Inspirum\Balikobot\Model\Status\Status;
use Inspirum\Balikobot\Model\Status\StatusCollection;
use Inspirum\Balikobot\Tests\BaseTestCase;

final class StatusCollectionTest extends BaseTestCase
{
    public function testCollection(): void
    {
        $carrier       = Carrier::from('cp');
        $collection    = new StatusCollection(
            $carrier,
            [
                new Status(
                    $carrier,
                    '1',
                    1.2,
                    'Zásilka byla doručena příjemci.',
                    'Zásilka byla doručena příjemci.',
                    'event',
                    null,
                ),
                new Status(
                    $carrier,
                    '2',
                    2.2,
                    'Zásilka je v přepravě.',
                    'Zásilka je v přepravě.',
                    'event',
                    null,
                ),
            ],
        );
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
        self::assertSame($expectedArray, $collection->__toArray());
    }
}
