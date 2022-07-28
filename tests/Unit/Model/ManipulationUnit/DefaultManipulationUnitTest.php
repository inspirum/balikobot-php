<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Model\ManipulationUnit;

use Inspirum\Balikobot\Model\ManipulationUnit\DefaultManipulationUnit;
use Inspirum\Balikobot\Tests\BaseTestCase;

final class DefaultManipulationUnitTest extends BaseTestCase
{
    public function testModel(): void
    {
        $model         =  new DefaultManipulationUnit(
            '32',
            'Balík',
        );
        $expectedArray = [
            'code' => '32',
            'name' => 'Balík',
        ];

        self::assertSame('32', $model->getCode());
        self::assertSame('Balík', $model->getName());
        self::assertSame($expectedArray, $model->__toArray());
    }
}
