<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Model\ManipulationUnit;

use DateTimeImmutable;
use Inspirum\Balikobot\Model\Carrier\Carrier;
use Inspirum\Balikobot\Model\Status\Status;
use Inspirum\Balikobot\Model\Status\Statuses;
use Inspirum\Balikobot\Tests\BaseTestCase;
use InvalidArgumentException;

final class StatusesTest extends BaseTestCase
{
    public function testGetter(): void
    {
        $carrier    = Carrier::from('cp');
        $collection = new Statuses($carrier, '3', [
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
        ]);

        self::assertSame($collection->getStates(), $collection->getItems());
    }

    public function testCarrierValidation(): void
    {
        self::expectException(InvalidArgumentException::class);
        self::expectExceptionMessage('Item carrier mismatch');

        $collection = new Statuses(Carrier::from('cp'), '2');

        $collection->offsetAdd(new Status(
            Carrier::from('ppl'),
            '2',
            2.2,
            'Zásilka je v přepravě.',
            'Doručování zásilky',
            'event',
            new DateTimeImmutable('2018-11-07 14:15:01'),
        ));

        $collection->offsetAdd(new Status(
            Carrier::from('cp'),
            '2',
            2.2,
            'Zásilka je v přepravě.',
            'Doručování zásilky',
            'event',
            new DateTimeImmutable('2018-11-07 14:15:01'),
        ));
    }

    public function testCarrierIdValidation(): void
    {
        self::expectException(InvalidArgumentException::class);
        self::expectExceptionMessage('Item carrier ID mismatch');

        $collection = new Statuses(Carrier::from('ppl'), '2');

        $collection->offsetAdd(new Status(
            Carrier::from('ppl'),
            '2',
            2.2,
            'Zásilka je v přepravě.',
            'Doručování zásilky',
            'event',
            new DateTimeImmutable('2018-11-07 14:15:01'),
        ));

        $collection->offsetAdd(new Status(
            Carrier::from('ppl'),
            '3',
            2.2,
            'Zásilka je v přepravě.',
            'Doručování zásilky',
            'event',
            new DateTimeImmutable('2018-11-07 14:15:01'),
        ));
    }
}
