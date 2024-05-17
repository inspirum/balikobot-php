<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Model\Service;

use Inspirum\Balikobot\Model\Service\DefaultServiceOption;
use Inspirum\Balikobot\Model\Service\DefaultServiceOptionCollection;
use Inspirum\Balikobot\Tests\Unit\BaseTestCase;

final class DefaultServiceOptionCollectionTest extends BaseTestCase
{
    public function testCollection(): void
    {
        $items = [
            new DefaultServiceOption(
                '3',
                'Dodejka',
            ),
            new DefaultServiceOption(
                '4',
                'Dobírka Pk A/MZ dobírka',
            ),
        ];
        $collection = new DefaultServiceOptionCollection($items);
        $expectedArray = [
            [
                'code' => '3',
                'name' => 'Dodejka',
            ],
            [
                'code' => '4',
                'name' => 'Dobírka Pk A/MZ dobírka',
            ],
        ];

        self::assertSame($items, $collection->getOptions());
        self::assertSame($expectedArray, $collection->__toArray());
    }
}
