<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Model\Method;

use Inspirum\Balikobot\Model\Method\DefaultMethod;
use Inspirum\Balikobot\Model\Method\DefaultMethodCollection;
use Inspirum\Balikobot\Tests\BaseTestCase;

final class DefaultMethodCollectionTest extends BaseTestCase
{
    public function testCollection(): void
    {
        $items         = [
            new DefaultMethod('ADD'),
            new DefaultMethod('TRACKSTATUS'),
        ];
        $collection    = new DefaultMethodCollection($items);
        $expectedArray = [
            [
                'code' => 'ADD',
            ],
            [
                'code' => 'TRACKSTATUS',
            ],
        ];

        self::assertSame($items, $collection->getMethods());
        self::assertSame($expectedArray, $collection->__toArray());
    }
}
