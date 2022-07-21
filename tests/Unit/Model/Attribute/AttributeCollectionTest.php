<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Model\Attribute;

use Inspirum\Balikobot\Model\Attribute\Attribute;
use Inspirum\Balikobot\Model\Attribute\AttributeCollection;
use Inspirum\Balikobot\Model\Carrier\Carrier;
use Inspirum\Balikobot\Tests\BaseTestCase;

final class AttributeCollectionTest extends BaseTestCase
{
    public function testCollection(): void
    {
        $carrier       = Carrier::from('cp');
        $collection    = new AttributeCollection(
            $carrier,
            [
                new Attribute(
                    'eid',
                    'string',
                    '40',
                ),
                new Attribute(
                    'services',
                    'plus_separated_values',
                    null,
                ),
                new Attribute(
                    'volume',
                    'float',
                    '9.20',
                ),
            ],
        );
        $expectedArray = [
            [
                'name'      => 'eid',
                'dataType'  => 'string',
                'maxLength' => '40',
            ],
            [
                'name'      => 'services',
                'dataType'  => 'plus_separated_values',
                'maxLength' => null,
            ],
            [
                'name'      => 'volume',
                'dataType'  => 'float',
                'maxLength' => '9.20',
            ],
        ];

        self::assertSame($carrier, $collection->getCarrier());
        self::assertSame($expectedArray, $collection->__toArray());
    }
}
