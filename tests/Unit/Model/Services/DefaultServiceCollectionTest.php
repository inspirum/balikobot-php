<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Model\Service;

use Inspirum\Balikobot\Model\Country\DefaultCodCountry;
use Inspirum\Balikobot\Model\Service\DefaultService;
use Inspirum\Balikobot\Model\Service\DefaultServiceCollection;
use Inspirum\Balikobot\Model\Service\DefaultServiceOption;
use Inspirum\Balikobot\Model\Service\DefaultServiceOptionCollection;
use Inspirum\Balikobot\Tests\Unit\BaseTestCase;

final class DefaultServiceCollectionTest extends BaseTestCase
{
    public function testCollection(): void
    {
        $carrier = 'cp';
        $items = [
            new DefaultService(
                'NP',
                'NP - Balík Na poštu',
                countries: [
                    'CZ',
                    'EU',
                ],
                options: new DefaultServiceOptionCollection([
                    new DefaultServiceOption(
                        '3',
                        'Dodejka',
                    ),
                    new DefaultServiceOption(
                        '4',
                        'Dobírka Pk A/MZ dobírka',
                    ),
                ]),
            ),
            new DefaultService(
                'RR',
                'RR - Doporučená zásilka Ekonomická',
                codCountries: [
                    new DefaultCodCountry(
                        'UA',
                        'UAH',
                        36000,
                    ),
                    new DefaultCodCountry(
                        'LV',
                        'USD',
                        2000,
                    ),
                ],
            ),
        ];
        $collection = new DefaultServiceCollection(
            $carrier,
            $items,
            false,
            true,
        );
        $expectedArray = [
            [
                'type' => 'NP',
                'name' => 'NP - Balík Na poštu',
                'options' => [
                    [
                        'code' => '3',
                        'name' => 'Dodejka',
                    ],
                    [
                        'code' => '4',
                        'name' => 'Dobírka Pk A/MZ dobírka',
                    ],
                ],
                'countries' => [
                    'CZ',
                    'EU',
                ],
                'codCountries' => null,
            ],
            [
                'type' => 'RR',
                'name' => 'RR - Doporučená zásilka Ekonomická',
                'options' => null,
                'countries' => null,
                'codCountries' => [
                    [
                        'code' => 'UA',
                        'currencyCode' => 'UAH',
                        'maxPrice' => 36000.0,
                    ],
                    [
                        'code' => 'LV',
                        'currencyCode' => 'USD',
                        'maxPrice' => 2000.0,
                    ],
                ],
            ],
        ];

        self::assertSame($carrier, $collection->getCarrier());
        self::assertSame($items, $collection->getServices());
        self::assertSame(['NP', 'RR'], $collection->getServiceCodes());
        self::assertSame(false, $collection->supportsParcel());
        self::assertSame(true, $collection->supportsCargo());
        self::assertSame($expectedArray, $collection->__toArray());
    }
}
