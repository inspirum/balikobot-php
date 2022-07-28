<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Model\Service;

use Inspirum\Balikobot\Model\Country\DefaultCodCountry;
use Inspirum\Balikobot\Model\Country\DefaultCountryFactory;
use Inspirum\Balikobot\Model\Service\DefaultService;
use Inspirum\Balikobot\Model\Service\DefaultServiceCollection;
use Inspirum\Balikobot\Model\Service\DefaultServiceFactory;
use Inspirum\Balikobot\Model\Service\DefaultServiceOption;
use Inspirum\Balikobot\Model\Service\DefaultServiceOptionCollection;
use Inspirum\Balikobot\Model\Service\ServiceCollection;
use Inspirum\Balikobot\Tests\BaseTestCase;
use Throwable;

final class DefaultServiceFactoryTest extends BaseTestCase
{
    /**
     * @param array<string,mixed> $data
     *
     * @dataProvider providesTestCreateCollection
     */
    public function testCreateCollection(string $carrier, array $data, ServiceCollection|Throwable $result): void
    {
        if ($result instanceof Throwable) {
            $this->expectException($result::class);
            $this->expectExceptionMessage($result->getMessage());
        }

        $factory = $this->newDefaultServiceFactory();

        $collection = $factory->createCollection($carrier, $data);

        self::assertEquals($result, $collection);
    }

    /**
     * @return iterable<array<string,mixed>>
     */
    public function providesTestCreateCollection(): iterable
    {
        yield 'services' => [
            'carrier' => 'cp',
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
            'result'  => new DefaultServiceCollection(
                'cp',
                [
                    new DefaultService(
                        'NP',
                        'NP - Balík Na poštu',
                    ),
                    new DefaultService(
                        'RR',
                        'RR - Doporučená zásilka Ekonomická',
                    ),
                ],
            ),
        ];

        yield 'activated_services' => [
            'carrier' => 'ppl',
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
            'result'  => new DefaultServiceCollection(
                'ppl',
                [
                    new DefaultService(
                        '2',
                        'PPL Parcel Connect',
                    ),
                    new DefaultService(
                        '3',
                        'PPL Parcel CZ Dopolední balík',
                    ),
                ],
                true,
                false,
            ),
        ];

        yield 'cod_countries' => [
            'carrier' => 'cp',
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
            'result'  => new DefaultServiceCollection(
                'cp',
                [
                    new DefaultService(
                        'DR',
                        null,
                        codCountries: [
                            new DefaultCodCountry(
                                'CZ',
                                'CZK',
                                10000,
                            ),
                        ],
                    ),
                    new DefaultService(
                        'VZP',
                        null,
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
                            new DefaultCodCountry(
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
            'carrier' => 'ppl',
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
            'result'  => new DefaultServiceCollection(
                'ppl',
                [
                    new DefaultService(
                        '1',
                        null,
                        countries: [
                            'CZ',
                            'UK',
                            'DE',
                        ],
                    ),
                    new DefaultService(
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
            'carrier' => 'cp',
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
            'result'  => new DefaultServiceCollection(
                'cp',
                [
                    new DefaultService(
                        'CE',
                        'CE - Obchodní balík do zahraničí',
                        options: new DefaultServiceOptionCollection([
                            new DefaultServiceOption(
                                '10',
                                'Neskladně',
                            ),
                            new DefaultServiceOption(
                                '44',
                                'Zboží s VDD (pouze pro zásilky do ciziny s celní zónou)',
                            ),
                        ]),
                    ),
                    new DefaultService(
                        'CV',
                        '',
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
                ],
            ),
        ];
    }

    private function newDefaultServiceFactory(): DefaultServiceFactory
    {
        return new DefaultServiceFactory(new DefaultCountryFactory());
    }
}
