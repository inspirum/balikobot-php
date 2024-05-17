<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Model\ManipulationUnit;

use DateTimeImmutable;
use Inspirum\Balikobot\Definitions\Carrier;
use Inspirum\Balikobot\Model\Status\DefaultStatus;
use Inspirum\Balikobot\Model\Status\DefaultStatusCollection;
use Inspirum\Balikobot\Model\Status\DefaultStatuses;
use Inspirum\Balikobot\Tests\Unit\BaseTestCase;
use InvalidArgumentException;

final class DefaultStatusesTest extends BaseTestCase
{
    public function testModel(): void
    {
        $carrier = 'cp';
        $items = [
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
        $collection = new DefaultStatuses($carrier, '3', new DefaultStatusCollection($carrier, $items));

        self::assertSame($carrier, $collection->getCarrier());
        self::assertSame('3', $collection->getCarrierId());
        self::assertSame($collection->getStates(), $collection->getStates());
    }

    public function testCarrierValidation(): void
    {
        self::expectException(InvalidArgumentException::class);
        self::expectExceptionMessage('Item carrier mismatch');

        new DefaultStatuses(Carrier::CP, '2', new DefaultStatusCollection(Carrier::CP, [
            new DefaultStatus(
                Carrier::PPL,
                '2',
                2.2,
                'Zásilka je v přepravě.',
                'Doručování zásilky',
                'event',
                new DateTimeImmutable('2018-11-07 14:15:01'),
            ),
            new DefaultStatus(
                Carrier::CP,
                '2',
                2.2,
                'Zásilka je v přepravě.',
                'Doručování zásilky',
                'event',
                new DateTimeImmutable('2018-11-07 14:15:01'),
            ),
        ]));
    }

    public function testCarrierIdValidation(): void
    {
        self::expectException(InvalidArgumentException::class);
        self::expectExceptionMessage('Item carrier ID mismatch');

        new DefaultStatuses(Carrier::PPL, '2', new DefaultStatusCollection(Carrier::PPL, [
            new DefaultStatus(
                Carrier::PPL,
                '2',
                2.2,
                'Zásilka je v přepravě.',
                'Doručování zásilky',
                'event',
                new DateTimeImmutable('2018-11-07 14:15:01'),
            ),
            new DefaultStatus(
                Carrier::PPL,
                '3',
                2.2,
                'Zásilka je v přepravě.',
                'Doručování zásilky',
                'event',
                new DateTimeImmutable('2018-11-07 14:15:01'),
            ),
        ]));
    }
}
