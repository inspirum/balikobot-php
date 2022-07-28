<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Model\ZipCode;

use Inspirum\Balikobot\Model\ZipCode\DefaultZipCode;
use Inspirum\Balikobot\Model\ZipCode\DefaultZipCodeFactory;
use Inspirum\Balikobot\Tests\BaseTestCase;
use Throwable;
use function iterator_to_array;

final class DefaultZipCodeFactoryTest extends BaseTestCase
{
    /**
     * @param array<string,mixed>                              $data
     * @param array<\Inspirum\Balikobot\Model\ZipCode\ZipCode> $result
     *
     * @dataProvider providesTestCreateIterator
     */
    public function testCreateIterator(string $carrier, string $service, ?string $country, array $data, array|Throwable $result): void
    {
        if ($result instanceof Throwable) {
            $this->expectException($result::class);
            $this->expectExceptionMessage($result->getMessage());
        }

        $factory = $this->newDefaultZipCodeFactory();

        $iterator = $factory->createIterator($carrier, $service, $country, $data);

        self::assertEquals($result, iterator_to_array($iterator));
    }

    /**
     * @return iterable<array<string,mixed>>
     */
    public function providesTestCreateIterator(): iterable
    {
        yield 'type_zip' => [
            'carrier' => 'cp',
            'service' => 'NP',
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
            'result'  => [
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
            ],
        ];

        yield 'type_range' => [
            'carrier' => 'ppl',
            'service' => '1',
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
            'result'  => [
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
            ],
        ];

        yield 'type_range_2' => [
            'carrier' => 'ppl',
            'service' => '1',
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
            'result'  => [
                new DefaultZipCode(
                    'ppl',
                    '1',
                    '25999',
                    '25999',
                    'AIXIRIVALL',
                    'AD',
                    false,
                ),
            ],
        ];

        yield 'type_city' => [
            'carrier' => 'ppl',
            'service' => '1',
            'country' => 'AE',
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
            'result'  => [
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
            ],
        ];
    }

    private function newDefaultZipCodeFactory(): DefaultZipCodeFactory
    {
        return new DefaultZipCodeFactory();
    }
}
