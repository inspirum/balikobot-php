<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Model\Service;

use Inspirum\Balikobot\Model\Carrier\Carrier;
use Inspirum\Balikobot\Model\Country\CodCountry;
use Inspirum\Balikobot\Model\Service\Service;
use Inspirum\Balikobot\Model\Service\ServiceCollection;
use Inspirum\Balikobot\Model\Service\ServiceOption;
use Inspirum\Balikobot\Model\Service\ServiceOptionCollection;
use Inspirum\Balikobot\Tests\BaseTestCase;

final class ServiceCollectionTest extends BaseTestCase
{
    public function testCollection(): void
    {
        $carrier       = Carrier::from('cp');
        $collection    = new ServiceCollection(
            $carrier,
            [
                new Service(
                    'NP',
                    'NP - Balík Na poštu',
                    countries: [
                        'CZ',
                        'EU',
                    ],
                    options: new ServiceOptionCollection([
                        new ServiceOption(
                            '3',
                            'Dodejka',
                        ),
                        new ServiceOption(
                            '4',
                            'Dobírka Pk A/MZ dobírka',
                        ),
                    ]),
                ),
                new Service(
                    'RR',
                    'RR - Doporučená zásilka Ekonomická',
                    codCountries: [
                        new CodCountry(
                            'UA',
                            'UAH',
                            36000,
                        ),
                        new CodCountry(
                            'LV',
                            'USD',
                            2000,
                        ),
                    ],
                ),
            ],
            false,
            true,
        );
        $expectedArray = [
            [
                'type'         => 'NP',
                'name'         => 'NP - Balík Na poštu',
                'options'      => [
                    [
                        'code' => '3',
                        'name' => 'Dodejka',
                    ],
                    [
                        'code' => '4',
                        'name' => 'Dobírka Pk A/MZ dobírka',
                    ],
                ],
                'countries'    => [
                    'CZ',
                    'EU',
                ],
                'codCountries' => null,
            ],
            [
                'type'         => 'RR',
                'name'         => 'RR - Doporučená zásilka Ekonomická',
                'options'      => null,
                'countries'    => null,
                'codCountries' => [
                    [
                        'code'         => 'UA',
                        'currencyCode' => 'UAH',
                        'maxPrice'     => 36000.0,
                    ],
                    [
                        'code'         => 'LV',
                        'currencyCode' => 'USD',
                        'maxPrice'     => 2000.0,
                    ],
                ],
            ],
        ];

        self::assertSame($carrier, $collection->getCarrier());
        self::assertSame(false, $collection->supportsParcel());
        self::assertSame(true, $collection->supportsCargo());
        self::assertSame($expectedArray, $collection->__toArray());
    }
}
