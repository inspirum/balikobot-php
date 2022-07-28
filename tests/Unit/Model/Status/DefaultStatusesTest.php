<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Model\ManipulationUnit;

use DateTimeImmutable;
use Inspirum\Balikobot\Model\Status\DefaultStatus;
use Inspirum\Balikobot\Model\Status\DefaultStatuses;
use Inspirum\Balikobot\Tests\BaseTestCase;
use InvalidArgumentException;

final class DefaultStatusesTest extends BaseTestCase
{
    public function testModel(): void
    {
        $carrier    = 'cp';
        $items      = [
            new DefaultStatus(
                $carrier,
                '3',
                2.2,
                'Zásilka je v přepravě.',
                'Doručování zásilky',
                'event',
                new DateTimeImmutable('2018-11-07 14:15:01'),
            ),
            new DefaultStatus(
                $carrier,
                '3',
                1.2,
                'Zásilka byla doručena příjemci.',
                'Dodání zásilky. (77072 - Depo Olomouc 72)',
                'event',
                new DateTimeImmutable('2018-11-08 18:00:00'),
            ),
        ];
        $collection = new DefaultStatuses($carrier, '3', $items);

        self::assertSame($carrier, $collection->getCarrier());
        self::assertSame('3', $collection->getCarrierId());
        self::assertSame($collection->getStates(), $collection->getStates());
    }

    public function testCarrierValidation(): void
    {
        self::expectException(InvalidArgumentException::class);
        self::expectExceptionMessage('Item carrier mismatch');

        $collection = new DefaultStatuses('cp', '2');

        $collection->offsetAdd(new DefaultStatus(
            'ppl',
            '2',
            2.2,
            'Zásilka je v přepravě.',
            'Doručování zásilky',
            'event',
            new DateTimeImmutable('2018-11-07 14:15:01'),
        ));

        $collection->offsetAdd(new DefaultStatus(
            'cp',
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

        $collection = new DefaultStatuses('ppl', '2');

        $collection->offsetAdd(new DefaultStatus(
            'ppl',
            '2',
            2.2,
            'Zásilka je v přepravě.',
            'Doručování zásilky',
            'event',
            new DateTimeImmutable('2018-11-07 14:15:01'),
        ));

        $collection->offsetAdd(new DefaultStatus(
            'ppl',
            '3',
            2.2,
            'Zásilka je v přepravě.',
            'Doručování zásilky',
            'event',
            new DateTimeImmutable('2018-11-07 14:15:01'),
        ));
    }
}
