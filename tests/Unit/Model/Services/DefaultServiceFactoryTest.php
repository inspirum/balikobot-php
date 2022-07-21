<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Model\Service;

use Inspirum\Balikobot\Model\Carrier\Carrier;
use Inspirum\Balikobot\Model\Country\CodCountry;
use Inspirum\Balikobot\Model\Country\DefaultCountryFactory;
use Inspirum\Balikobot\Model\Service\DefaultServiceFactory;
use Inspirum\Balikobot\Model\Service\Service;
use Inspirum\Balikobot\Model\Service\ServiceCollection;
use Inspirum\Balikobot\Model\Service\ServiceOption;
use Inspirum\Balikobot\Model\Service\ServiceOptionCollection;
use Inspirum\Balikobot\Tests\BaseTestCase;
use Throwable;

final class DefaultServiceFactoryTest extends BaseTestCase
{
    /**
     * @param array<string,mixed> $data
     *
     * @dataProvider providesTestCreateCollection
     */
    public function testCreateCollection(Carrier $carrier, array $data, ServiceCollection|Throwable $result): void
    {
        if ($result instanceof Throwable) {
            $this->expectException($result::class);
            $this->expectExceptionMessage($result->getMessage());
        }

        $factory = $this->newDefaultUnitFactory();

        $collection = $factory->createCollection($carrier, $data);

        self::assertEquals($result, $collection);
    }

    /**
     * @return iterable<array<string,mixed>>
     */
    public function providesTestCreateCollection(): iterable
    {
        yield 'services' => [
            'carrier' => Carrier::from('cp'),
            'data'    => [
                'status'        => 200,
                'service_types' => [
                    [
                        'service_type' => 'NP',
                        'name'         => 'NP - Balík Na poštu',
                    ],
                    [
                        'service_type' => 'RR',
                        'name'         => 'RR - Doporučená zásilka Ekonomická',
                    ],
                ],
            ],
            'result'  => new ServiceCollection(
                Carrier::from('cp'),
                [
                    new Service(
                        'NP',
                        'NP - Balík Na poštu',
                    ),
                    new Service(
                        'RR',
                        'RR - Doporučená zásilka Ekonomická',
                    ),
                ],
            ),
        ];

        yield 'activated_services' => [
            'carrier' => Carrier::from('ppl'),
            'data'    => [
                'status'        => 200,
                'active_parcel' => true,
                'active_cargo'  => false,
                'service_types' => [
                    [
                        'service_type' => 2,
                        'name'         => 'PPL Parcel Connect',
                    ],
                    [
                        'service_type' => 3,
                        'name'         => 'PPL Parcel CZ Dopolední balík',
                    ],
                ],
            ],
            'result'  => new ServiceCollection(
                Carrier::from('ppl'),
                [
                    new Service(
                        '2',
                        'PPL Parcel Connect',
                    ),
                    new Service(
                        '3',
                        'PPL Parcel CZ Dopolední balík',
                    ),
                ],
                true,
                false,
            ),
        ];

        yield 'cod_countries' => [
            'carrier' => Carrier::from('cp'),
            'data'    => [
                'status'        => 200,
                'service_types' => [
                    [
                        'service_type'  => 'DR',
                        'cod_countries' => [
                            'CZ' => [
                                'max_price' => 10000,
                                'currency'  => 'CZK',
                            ],
                        ],
                    ],
                    [
                        'service_type'  => 'VZP',
                        'cod_countries' => [
                            'UA' => [
                                'max_price' => 36000,
                                'currency'  => 'UAH',
                            ],
                            'LV' => [
                                'max_price' => 2000,
                                'currency'  => 'USD',
                            ],
                            'HU' => [
                                'max_price' => 2500,
                                'currency'  => 'EUR',
                            ],
                        ],
                    ],
                ],
            ],
            'result'  => new ServiceCollection(
                Carrier::from('cp'),
                [
                    new Service(
                        'DR',
                        null,
                        codCountries: [
                            new CodCountry(
                                'CZ',
                                'CZK',
                                10000,
                            ),
                        ],
                    ),
                    new Service(
                        'VZP',
                        null,
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
                            new CodCountry(
                                'HU',
                                'EUR',
                                2500,
                            ),
                        ],
                    ),
                ],
            ),
        ];

        yield 'countries' => [
            'carrier' => Carrier::from('ppl'),
            'data'    => [
                'status'        => 200,
                'service_types' => [
                    [
                        'service_type' => 1,
                        'countries'    => [
                            'CZ',
                            'UK',
                            'DE',
                        ],
                    ],
                    [
                        'service_type' => 4,
                        'countries'    => [
                            'CZ',
                            'SK',
                        ],
                    ],
                ],
            ],
            'result'  => new ServiceCollection(
                Carrier::from('ppl'),
                [
                    new Service(
                        '1',
                        null,
                        countries: [
                            'CZ',
                            'UK',
                            'DE',
                        ],
                    ),
                    new Service(
                        '4',
                        null,
                        countries:[
                            'CZ',
                            'SK',
                        ],
                    ),
                ],
            ),
        ];

        yield 'service_options' => [
            'carrier' => Carrier::from('cp'),
            'data'    => [
                'status'        => 200,
                'service_types' => [
                    [
                        'service_type'      => 'CE',
                        'service_type_name' => 'CE - Obchodní balík do zahraničí',
                        'services'          => [
                            [
                                'name' => 'Neskladně',
                                'code' => '10',
                            ],
                            [
                                'name' => 'Zboží s VDD (pouze pro zásilky do ciziny s celní zónou)',
                                'code' => '44',
                            ],
                        ],
                    ],
                    [
                        'service_type'      => 'CV',
                        'service_type_name' => '',
                        'services'          => [
                            [
                                'name' => 'Dodejka',
                                'code' => '3',
                            ],
                            [
                                'name' => 'Dobírka Pk A/MZ dobírka',
                                'code' => '4',
                            ],
                        ],
                    ],
                ],
            ],
            'result'  => new ServiceCollection(
                Carrier::from('cp'),
                [
                    new Service(
                        'CE',
                        'CE - Obchodní balík do zahraničí',
                        options: new ServiceOptionCollection([
                            new ServiceOption(
                                '10',
                                'Neskladně',
                            ),
                            new ServiceOption(
                                '44',
                                'Zboží s VDD (pouze pro zásilky do ciziny s celní zónou)',
                            ),
                        ]),
                    ),
                    new Service(
                        'CV',
                        '',
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
                ],
            ),
        ];
    }

    private function newDefaultUnitFactory(): DefaultServiceFactory
    {
        return new DefaultServiceFactory(new DefaultCountryFactory());
    }
}
