<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Model\Method;

use Inspirum\Balikobot\Model\Method\Method;
use Inspirum\Balikobot\Tests\BaseTestCase;

final class MethodTest extends BaseTestCase
{
    public function testGetter(): void
    {
        $model = new Method('ADD');

        self::assertSame('ADD', $model->getValue());
    }
}
