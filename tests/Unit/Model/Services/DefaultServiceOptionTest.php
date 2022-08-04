<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Model\Services;

use Inspirum\Balikobot\Model\Service\DefaultServiceOption;
use Inspirum\Balikobot\Tests\Unit\BaseTestCase;

final class DefaultServiceOptionTest extends BaseTestCase
{
    public function testModel(): void
    {
        $model         = new DefaultServiceOption(
            '3',
            'Dodejka',
        );
        $expectedArray = [
            'code' => '3',
            'name' => 'Dodejka',
        ];

        self::assertSame('3', $model->getCode());
        self::assertSame('Dodejka', $model->getName());
        self::assertSame($expectedArray, $model->__toArray());
    }
}
