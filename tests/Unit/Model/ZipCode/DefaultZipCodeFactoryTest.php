<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Model\ZipCode;

use ArrayIterator;
use Inspirum\Balikobot\Definitions\Carrier;
use Inspirum\Balikobot\Definitions\Country;
use Inspirum\Balikobot\Definitions\ServiceType;
use Inspirum\Balikobot\Model\ZipCode\DefaultZipCode;
use Inspirum\Balikobot\Model\ZipCode\DefaultZipCodeFactory;
use Inspirum\Balikobot\Model\ZipCode\DefaultZipCodeIterator;
use Inspirum\Balikobot\Model\ZipCode\ZipCodeIterator;
use Inspirum\Balikobot\Tests\Unit\BaseTestCase;
use Throwable;
use Traversable;
use function iterator_to_array;

final class DefaultZipCodeFactoryTest extends BaseTestCase
{
    /**
     * @param array<string,mixed> $data
     *
     * @dataProvider providesTestCreateIterator
     */
    public function testCreateIterator(string $carrier, string $service, ?string $country, array $data, ZipCodeIterator|Throwable $result): void
    {
        if ($result instanceof Throwable) {
            $this->expectException($result::class);
            $this->expectExceptionMessage($result->getMessage());
        }

        $factory = $this->newDefaultZipCodeFactory();

        $iterator = $factory->createIterator($carrier, $service, $country, $data);

        self::assertEquals($result, $iterator);
        if ($result instanceof Traversable) {
            self::assertEquals(iterator_to_array($result), iterator_to_array($iterator));
        }
    }

    /**
     * @return iterable<array<string,mixed>>
     */
    public function providesTestCreateIterator(): iterable
    {
        yield 'type_zip' => [
            'carrier' => Carrier::CP,
            'service' => ServiceType::CP_NP,
            'country' => null,
            'data'    => [
                'status'       => 200,
                'service_type' => 'NP',
                'type'         => 'zip',
                'zip_codes'    => [
                    [
                        'zip'     => '35002',
                        '1B'      => false,
                        'country' => 'CZ',
                    ],
                    [
                        'zip'     => '19000',
                        '1B'      => true,
                        'country' => 'CZ',
                    ],
                ],
            ],
            'result'  => new DefaultZipCodeIterator(
                Carrier::CP,
                ServiceType::CP_NP,
                new ArrayIterator([
                    new DefaultZipCode(
                        'cp',
                        'NP',
                        '35002',
                        null,
                        null,
                        'CZ',
                        false,
                    ),
                    new DefaultZipCode(
                        'cp',
                        'NP',
                        '19000',
                        null,
                        null,
                        'CZ',
                        true,
                    ),
                ]),
            ),
        ];

        yield 'type_range' => [
            'carrier' => Carrier::PPL,
            'service' => ServiceType::PPL_PARCEL_BUSSINESS_CZ,
            'country' => null,
            'data'    => [
                'status'       => 200,
                'service_type' => '1',
                'type'         => 'zip_range',
                'zip_codes'    => [
                    [
                        'zip_start' => '10000',
                        'zip_end'   => '10199',
                        'country'   => 'CZ',
                    ],
                    [
                        'zip_start' => '35000',
                        'zip_end'   => '35299',
                        'country'   => 'CZ',
                    ],
                ],
            ],
            'result'  => new DefaultZipCodeIterator(
                Carrier::PPL,
                ServiceType::PPL_PARCEL_BUSSINESS_CZ,
                new ArrayIterator([
                    new DefaultZipCode(
                        'ppl',
                        '1',
                        '10000',
                        '10199',
                        null,
                        'CZ',
                        false,
                    ),
                    new DefaultZipCode(
                        'ppl',
                        '1',
                        '35000',
                        '35299',
                        null,
                        'CZ',
                        false,
                    ),
                ]),
            ),
        ];

        yield 'type_range_2' => [
            'carrier' => Carrier::PPL,
            'service' => ServiceType::PPL_PARCEL_BUSSINESS_CZ,
            'country' => null,
            'data'    => [
                'status'       => 200,
                'service_type' => '1',
                'type'         => 'zip_range',
                'country'      => 'AD',
                'zip_codes'    => [
                    [
                        'city'      => 'AIXIRIVALL',
                        'zip_start' => '25999',
                        'zip_end'   => '25999',
                    ],
                ],
            ],
            'result'  => new DefaultZipCodeIterator(
                Carrier::PPL,
                ServiceType::PPL_PARCEL_BUSSINESS_CZ,
                new ArrayIterator([
                    new DefaultZipCode(
                        'ppl',
                        '1',
                        '25999',
                        '25999',
                        'AIXIRIVALL',
                        'AD',
                        false,
                    ),
                ]),
            ),
        ];

        yield 'type_city' => [
            'carrier' => Carrier::PPL,
            'service' => ServiceType::PPL_PARCEL_BUSSINESS_CZ,
            'country' => Country::UNITED_ARAB_EMIRATES,
            'data'    => [
                'status'       => 200,
                'service_type' => '1',
                'type'         => 'city',
                'zip_codes'    => [
                    [
                        'city' => 'ABU DHABI',
                    ],
                    [
                        'city' => 'AJMAN CITY',
                    ],
                ],
            ],
            'result'  => new DefaultZipCodeIterator(
                Carrier::PPL,
                ServiceType::PPL_PARCEL_BUSSINESS_CZ,
                new ArrayIterator([
                    new DefaultZipCode(
                        'ppl',
                        '1',
                        '',
                        null,
                        'ABU DHABI',
                        'AE',
                        false,
                    ),
                    new DefaultZipCode(
                        'ppl',
                        '1',
                        '',
                        null,
                        'AJMAN CITY',
                        'AE',
                        false,
                    ),
                ]),
            ),
        ];
    }

    private function newDefaultZipCodeFactory(): DefaultZipCodeFactory
    {
        return new DefaultZipCodeFactory();
    }
}
