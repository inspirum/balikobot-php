<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Model\Country;

use Inspirum\Balikobot\Model\Country\DefaultCountry;
use Inspirum\Balikobot\Tests\BaseTestCase;

final class DefaultCountryTest extends BaseTestCase
{
    public function testModel(): void
    {
        $model = new DefaultCountry(
            [
                'cs' => 'Portoriko',
                'en' => 'Puerto Rico',
            ],
            'PR',
            'USD',
            [
                '+1787',
                '+1939',
            ],
            'America',
        );

        self::assertSame([
            'cs' => 'Portoriko',
            'en' => 'Puerto Rico',
        ], $model->getNames());
        self::assertSame('Portoriko', $model->getName('cs'));
        self::assertSame('Puerto Rico', $model->getName('en'));
        self::assertSame(null, $model->getName('sk'));
        self::assertSame('PR', $model->getCode());
        self::assertSame('USD', $model->getCurrencyCode());
        self::assertSame([
            '+1787',
            '+1939',
        ], $model->getPhonePrefixes());
        self::assertSame('+1787', $model->getPhonePrefix());
        self::assertSame('America', $model->getContinent());
    }
}
