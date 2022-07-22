<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Model\ManipulationUnit;

use DateTimeImmutable;
use Inspirum\Balikobot\Model\Carrier\Carrier;
use Inspirum\Balikobot\Model\Status\Status;
use Inspirum\Balikobot\Model\Status\Statuses;
use Inspirum\Balikobot\Model\Status\StatusesCollection;
use Inspirum\Balikobot\Tests\BaseTestCase;

final class StatusesCollectionTest extends BaseTestCase
{
    public function testCollection(): void
    {
        $carrier       = Carrier::from('cp');
        $collection    = new StatusesCollection($carrier, [
            new Statuses($carrier, '3', [
                new Status(
                    $carrier,
                    '3',
                    2.2,
                    'Zásilka je v přepravě.',
                    'Doručování zásilky',
                    'event',
                    new DateTimeImmutable('2018-11-07 14:15:01'),
                ),
                new Status(
                    $carrier,
                    '3',
                    1.2,
                    'Zásilka byla doručena příjemci.',
                    'Dodání zásilky. (77072 - Depo Olomouc 72)',
                    'event',
                    new DateTimeImmutable('2018-11-08 18:00:00'),
                ),
            ]),
            new Statuses($carrier, '4', [
                new Status(
                    $carrier,
                    '4',
                    2.2,
                    'Zásilka je v přepravě.',
                    'Doručování zásilky',
                    'event',
                    new DateTimeImmutable('2018-11-07 14:15:01'),
                ),
            ]),
        ]);
        $expectedArray = [
            [
                'carrier'   => 'cp',
                'carrierId' => '3',
                'states'    => [
                    [
                        'carrier'     => 'cp',
                        'carrierId'   => '3',
                        'id'          => 2.2,
                        'name'        => 'Zásilka je v přepravě.',
                        'description' => 'Doručování zásilky',
                        'type'        => 'event',
                        'date'        => '2018-11-07T14:15:01+00:00',
                    ],
                    [
                        'carrier'     => 'cp',
                        'carrierId'   => '3',
                        'id'          => 1.2,
                        'name'        => 'Zásilka byla doručena příjemci.',
                        'description' => 'Dodání zásilky. (77072 - Depo Olomouc 72)',
                        'type'        => 'event',
                        'date'        => '2018-11-08T18:00:00+00:00',
                    ],
                ],
            ],
            [
                'carrier'   => 'cp',
                'carrierId' => '4',
                'states'    => [
                    [
                        'carrier'     => 'cp',
                        'carrierId'   => '4',
                        'id'          => 2.2,
                        'name'        => 'Zásilka je v přepravě.',
                        'description' => 'Doručování zásilky',
                        'type'        => 'event',
                        'date'        => '2018-11-07T14:15:01+00:00',
                    ],
                ],
            ],
        ];

        self::assertSame($carrier, $collection->getCarrier());
        self::assertSame($expectedArray, $collection->__toArray());
    }
}
