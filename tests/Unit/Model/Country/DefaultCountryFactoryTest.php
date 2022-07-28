<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Model\Country;

use Inspirum\Balikobot\Model\Country\CountryCollection;
use Inspirum\Balikobot\Model\Country\DefaultCountry;
use Inspirum\Balikobot\Model\Country\DefaultCountryCollection;
use Inspirum\Balikobot\Model\Country\DefaultCountryFactory;
use Inspirum\Balikobot\Tests\BaseTestCase;
use Throwable;

final class DefaultCountryFactoryTest extends BaseTestCase
{
    /**
     * @param array<string,mixed> $data
     *
     * @dataProvider providesTestCreateCollection
     */
    public function testCreateCollection(array $data, CountryCollection|Throwable $result): void
    {
        if ($result instanceof Throwable) {
            $this->expectException($result::class);
            $this->expectExceptionMessage($result->getMessage());
        }

        $factory = $this->newDefaultCountryFactory();

        $collection = $factory->createCollection($data);

        self::assertEquals($result, $collection);
    }

    /**
     * @return iterable<array<string,mixed>>
     */
    public function providesTestCreateCollection(): iterable
    {
        yield 'valid' => [
            'data'    => [
                'status' => 200,
                'countries' => [
                    [
                        'name_en'      => 'Andorra',
                        'name_cz'      => 'Andorra',
                        'iso_code'     => 'AD',
                        'phone_prefix' => '+376',
                        'currency'     => 'EUR',
                        'continent'    => 'Europe',
                    ],
                    [
                        'name_en'      => 'Puerto Rico',
                        'name_cz'      => 'Portoriko',
                        'iso_code'     => 'PR',
                        'phone_prefix' => [
                            '+1787',
                            '+1939',
                        ],
                        'currency'     => 'USD',
                        'continent'    => 'America',
                    ],
                ],
            ],
            'result'  => new DefaultCountryCollection(
                [
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
                ],
            ),
        ];
    }

    private function newDefaultCountryFactory(): DefaultCountryFactory
    {
        return new DefaultCountryFactory();
    }
}
