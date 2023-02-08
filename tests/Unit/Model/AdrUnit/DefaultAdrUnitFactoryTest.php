<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Model\AdrUnit;

use Inspirum\Balikobot\Model\AdrUnit\AdrUnitCollection;
use Inspirum\Balikobot\Model\AdrUnit\DefaultAdrUnit;
use Inspirum\Balikobot\Model\AdrUnit\DefaultAdrUnitCollection;
use Inspirum\Balikobot\Model\AdrUnit\DefaultAdrUnitFactory;
use Inspirum\Balikobot\Tests\Unit\BaseTestCase;
use PHPUnit\Framework\Attributes\DataProvider;
use Throwable;

final class DefaultAdrUnitFactoryTest extends BaseTestCase
{
    /**
     * @param array<string,mixed> $data
     */
    #[DataProvider('providesTestCreateCollection')]
    public function testCreateCollection(string $carrier, array $data, AdrUnitCollection|Throwable $result): void
    {
        if ($result instanceof Throwable) {
            $this->expectException($result::class);
            $this->expectExceptionMessage($result->getMessage());
        }

        $factory = $this->newDefaultAdrUnitFactory();

        $collection = $factory->createCollection($carrier, $data);

        self::assertEquals($result, $collection);
    }

    /**
     * @return iterable<array<string,mixed>>
     */
    public static function providesTestCreateCollection(): iterable
    {
        yield 'valid' => [
            'carrier' => 'ppl',
            'data'    => [
                'status' => 200,
                'units'  => [
                    [
                        'id'                 => '299',
                        'code'               => '432',
                        'name'               => 'PŘEDMĚTY PYROTECHNICKÉ pro technické účely',
                        'class'              => '1',
                        'packaging'          => null,
                        'tunnel_code'        => 'E',
                        'transport_category' => '4',
                    ],
                    [
                        'id'                 => '377',
                        'code'               => '1001',
                        'name'               => 'ACETYLÉN, ROZPUŠTĚNÝ',
                        'class'              => '2',
                        'packaging'          => 'A',
                        'tunnel_code'        => null,
                        'transport_category' => '2',
                    ],
                ],
            ],
            'result'  => new DefaultAdrUnitCollection(
                'ppl',
                [
                    new DefaultAdrUnit(
                        'ppl',
                        '299',
                        '432',
                        'PŘEDMĚTY PYROTECHNICKÉ pro technické účely',
                        '1',
                        null,
                        'E',
                        '4',
                    ),
                    new DefaultAdrUnit(
                        'ppl',
                        '377',
                        '1001',
                        'ACETYLÉN, ROZPUŠTĚNÝ',
                        '2',
                        'A',
                        null,
                        '2',
                    ),
                ],
            ),
        ];
    }

    private function newDefaultAdrUnitFactory(): DefaultAdrUnitFactory
    {
        return new DefaultAdrUnitFactory();
    }
}
