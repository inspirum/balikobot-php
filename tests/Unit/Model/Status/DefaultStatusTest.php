<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Model\ManipulationUnit;

use DateTimeImmutable;
use Inspirum\Balikobot\Model\Status\DefaultStatus;
use Inspirum\Balikobot\Tests\Unit\BaseTestCase;

final class DefaultStatusTest extends BaseTestCase
{
    public function testModel(): void
    {
        $carrier = 'cp';
        $date = new DateTimeImmutable('2018-11-07 14:15:01');
        $model = new DefaultStatus(
            $carrier,
            '3',
            2.2,
            'Zásilka je v přepravě.',
            'Doručování zásilky',
            'event',
            $date,
        );

        self::assertSame($carrier, $model->getCarrier());
        self::assertSame('3', $model->getCarrierId());
        self::assertSame(2.2, $model->getId());
        self::assertSame('Zásilka je v přepravě.', $model->getName());
        self::assertSame('Doručování zásilky', $model->getDescription());
        self::assertSame('event', $model->getType());
        self::assertSame($date, $model->getDate());
    }
}
