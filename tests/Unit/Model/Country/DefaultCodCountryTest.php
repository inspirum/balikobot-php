<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Model\Country;

use Inspirum\Balikobot\Model\Country\DefaultCodCountry;
use Inspirum\Balikobot\Tests\BaseTestCase;

final class DefaultCodCountryTest extends BaseTestCase
{
    public function testModel(): void
    {
        $model = new DefaultCodCountry(
            'CZ',
            'CZK',
            10000,
        );

        self::assertSame('CZ', $model->getCode());
        self::assertSame('CZK', $model->getCurrencyCode());
        self::assertSame(10000.0, $model->getMaxPrice());
    }
}
