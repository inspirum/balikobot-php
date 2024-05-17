<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Model\Attribute;

use Inspirum\Balikobot\Model\Attribute\DefaultAttribute;
use Inspirum\Balikobot\Tests\Unit\BaseTestCase;

final class DefaultAttributeTest extends BaseTestCase
{
    public function testModel(): void
    {
        $model = new DefaultAttribute(
            'eid',
            'string',
            '40',
        );
        $expectedArray = [
            'name' => 'eid',
            'dataType' => 'string',
            'maxLength' => '40',
        ];

        self::assertSame('eid', $model->getName());
        self::assertSame('string', $model->getDataType());
        self::assertSame('40', $model->getMaxLength());
        self::assertSame($expectedArray, $model->__toArray());
    }
}
