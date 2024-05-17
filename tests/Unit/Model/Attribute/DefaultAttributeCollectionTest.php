<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Model\Attribute;

use Inspirum\Balikobot\Definitions\Carrier;
use Inspirum\Balikobot\Model\Attribute\DefaultAttribute;
use Inspirum\Balikobot\Model\Attribute\DefaultAttributeCollection;
use Inspirum\Balikobot\Tests\Unit\BaseTestCase;

final class DefaultAttributeCollectionTest extends BaseTestCase
{
    public function testCollection(): void
    {
        $carrier = Carrier::CP;
        $items = [
            new DefaultAttribute(
                'eid',
                'string',
                '40',
            ),
            new DefaultAttribute(
                'services',
                'plus_separated_values',
                null,
            ),
            new DefaultAttribute(
                'volume',
                'float',
                '9.20',
            ),
        ];
        $collection = new DefaultAttributeCollection($carrier, $items);
        $expectedArray = [
            [
                'name' => 'eid',
                'dataType' => 'string',
                'maxLength' => '40',
            ],
            [
                'name' => 'services',
                'dataType' => 'plus_separated_values',
                'maxLength' => null,
            ],
            [
                'name' => 'volume',
                'dataType' => 'float',
                'maxLength' => '9.20',
            ],
        ];

        self::assertSame($carrier, $collection->getCarrier());
        self::assertSame($items, $collection->getAttributes());
        self::assertSame($expectedArray, $collection->__toArray());
    }
}
