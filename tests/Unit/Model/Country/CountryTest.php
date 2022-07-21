<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Model\Country;

use Inspirum\Balikobot\Model\Country\Country;
use Inspirum\Balikobot\Tests\BaseTestCase;

final class CountryTest extends BaseTestCase
{
    public function testModel(): void
    {
        $model = new Country(
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

        self::assertSame('+1787', $model->getPhonePrefix());
        self::assertSame('Portoriko', $model->getName('cs'));
        self::assertSame('Puerto Rico', $model->getName('en'));
        self::assertSame(null, $model->getName('sk'));
    }
}
