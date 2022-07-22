<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Model\Method;

use Inspirum\Balikobot\Model\Method\Method;
use Inspirum\Balikobot\Model\Method\MethodCollection;
use Inspirum\Balikobot\Tests\BaseTestCase;

final class MethodCollectionTest extends BaseTestCase
{
    public function testCollection(): void
    {
        $collection    = new MethodCollection([
            new Method('ADD'),
            new Method('TRACKSTATUS'),
        ]);
        $expectedArray = [
            [
                'code' => 'ADD',
            ],
            [
                'code' => 'TRACKSTATUS',
            ],
        ];

        self::assertSame($expectedArray, $collection->__toArray());
    }
}
