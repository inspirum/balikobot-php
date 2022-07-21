<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Model\Country;

use Inspirum\Balikobot\Model\Country\Country;
use Inspirum\Balikobot\Model\Country\CountryCollection;
use Inspirum\Balikobot\Tests\BaseTestCase;

final class CountryCollectionTest extends BaseTestCase
{
    public function testCollection(): void
    {
        $collection    = new CountryCollection(
            [
                new Country(
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
                new Country(
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
            ],
        );
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

        self::assertSame($expectedArray, $collection->__toArray());
    }
}
