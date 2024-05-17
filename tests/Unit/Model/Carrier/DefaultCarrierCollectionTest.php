<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Model\Carrier;

use Inspirum\Balikobot\Model\Carrier\DefaultCarrier;
use Inspirum\Balikobot\Model\Carrier\DefaultCarrierCollection;
use Inspirum\Balikobot\Tests\Unit\BaseTestCase;

final class DefaultCarrierCollectionTest extends BaseTestCase
{
    public function testCollection(): void
    {
        $items = [
            new DefaultCarrier(
                'cp',
                'Česká pošta',
            ),
            new DefaultCarrier(
                'ppl',
                'PPL',
            ),
            new DefaultCarrier(
                'magyarposta',
                'Magyar Posta',
            ),
        ];
        $collection = new DefaultCarrierCollection($items);
        $expectedArray = [
            [
                'code' => 'cp',
                'name' => 'Česká pošta',
                'methods' => [],
            ],
            [
                'code' => 'ppl',
                'name' => 'PPL',
                'methods' => [],
            ],
            [
                'code' => 'magyarposta',
                'name' => 'Magyar Posta',
                'methods' => [],
            ],
        ];

        self::assertSame($items, $collection->getCarriers());
        self::assertSame(['cp', 'ppl', 'magyarposta'], $collection->getCarrierCodes());
        self::assertSame($expectedArray, $collection->__toArray());
    }
}
