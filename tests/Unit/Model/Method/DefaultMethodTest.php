<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Model\Method;

use Inspirum\Balikobot\Model\Method\DefaultMethod;
use Inspirum\Balikobot\Tests\Unit\BaseTestCase;

final class DefaultMethodTest extends BaseTestCase
{
    public function testGetter(): void
    {
        $model = new DefaultMethod('ADD');

        self::assertSame('ADD', $model->getCode());
    }
}
