<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Model\ManipulationUnit;

use Inspirum\Balikobot\Model\BasePerCarrierCollection;
use Inspirum\Balikobot\Model\Status\DefaultStatus;
use Inspirum\Balikobot\Tests\BaseTestCase;
use InvalidArgumentException;
use RuntimeException;

final class BasePerCarrierCollectionTest extends BaseTestCase
{
    public function testGetter(): void
    {
        $carrier    = 'cp';
        $items      = [
            new DefaultStatus(
                $carrier,
                '1',
                1.0,
                'name',
                'desc',
                'event',
                null,
            ),
            new DefaultStatus(
                $carrier,
                '2',
                1.0,
                'name',
                'desc',
                'event',
                null,
            ),
            new DefaultStatus(
                $carrier,
                '3',
                1.0,
                'name',
                'desc',
                'event',
                null,
            ),
        ];
        $collection = new class ($carrier, $items) extends BasePerCarrierCollection {
        };

        self::assertSame($carrier, $collection->getCarrier());
        self::assertSame(null, $collection->getForCarrierId('4'));
        self::assertSame($items[2], $collection->getForCarrierId('3'));
        self::assertSame(['1', '2', '3'], $collection->getCarrierIds());
    }

    public function testEmptyCollection(): void
    {
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Collection is empty');

        $collection = new class () extends BasePerCarrierCollection {
        };

        $collection->getCarrier();
    }

    public function testFirstItemCarrier(): void
    {
        $collection = new class () extends BasePerCarrierCollection {
        };

        $carrier = 'ppl';

        $collection->add(new DefaultStatus(
            $carrier,
            '1',
            1.0,
            'name',
            'desc',
            'event',
            null,
        ));

        self::assertSame($carrier, $collection->getCarrier());
    }

    public function testCarrierAddValidation(): void
    {
        self::expectException(InvalidArgumentException::class);
        self::expectExceptionMessage('Item carrier mismatch');

        $carrier    = 'ppl';
        $collection = new class ($carrier) extends BasePerCarrierCollection {
        };

        $collection->add(new DefaultStatus(
            'cp',
            '1',
            1.0,
            'name',
            'desc',
            'event',
            null,
        ));
    }

    public function testCarrierSetValidation(): void
    {
        self::expectException(InvalidArgumentException::class);
        self::expectExceptionMessage('Item carrier mismatch');

        $carrier    = 'ppl';
        $collection = new class ($carrier, [
            new DefaultStatus(
                'ppl',
                '1',
                1.0,
                'name',
                'desc',
                'event',
                null,
            ),
        ]) extends BasePerCarrierCollection {
        };

        $collection->offsetSet(0, new DefaultStatus(
            'cp',
            '1',
            1.0,
            'name',
            'desc',
            'event',
            null,
        ));
    }
}
