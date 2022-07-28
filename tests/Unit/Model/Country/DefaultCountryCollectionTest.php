<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Model\Country;

use Inspirum\Balikobot\Model\Country\DefaultCountry;
use Inspirum\Balikobot\Model\Country\DefaultCountryCollection;
use Inspirum\Balikobot\Tests\BaseTestCase;

final class DefaultCountryCollectionTest extends BaseTestCase
{
    public function testCollection(): void
    {
        $items         = [
            new DefaultCountry(
                [
                    'cs' => 'Andorra',
                    'en' => 'Andorra',
                ],
                'AD',
                'EUR',
                [
                    '+376',
                ],
                'Europe',
            ),
            new DefaultCountry(
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
            ),
        ];
        $collection    = new DefaultCountryCollection($items);
        $expectedArray = [
            [
                'names'         => [
                    'cs' => 'Andorra',
                    'en' => 'Andorra',
                ],
                'code'          => 'AD',
                'currencyCode'  => 'EUR',
                'phonePrefixes' => [
                    '+376',
                ],
                'continent'     => 'Europe',
            ],
            [
                'names'         => [
                    'cs' => 'Portoriko',
                    'en' => 'Puerto Rico',
                ],
                'code'          => 'PR',
                'currencyCode'  => 'USD',
                'phonePrefixes' => [
                    '+1787',
                    '+1939',
                ],
                'continent'     => 'America',
            ],
        ];

        self::assertSame($items, $collection->getCountries());
        self::assertSame($expectedArray, $collection->__toArray());
    }
}
