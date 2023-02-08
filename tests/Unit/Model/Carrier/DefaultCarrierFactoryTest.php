<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Model\Carrier;

use Inspirum\Balikobot\Model\Carrier\Carrier;
use Inspirum\Balikobot\Model\Carrier\CarrierCollection;
use Inspirum\Balikobot\Model\Carrier\DefaultCarrier;
use Inspirum\Balikobot\Model\Carrier\DefaultCarrierCollection;
use Inspirum\Balikobot\Model\Carrier\DefaultCarrierFactory;
use Inspirum\Balikobot\Model\Method\DefaultMethod;
use Inspirum\Balikobot\Model\Method\DefaultMethodCollection;
use Inspirum\Balikobot\Model\Method\DefaultMethodFactory;
use Inspirum\Balikobot\Tests\Unit\BaseTestCase;
use PHPUnit\Framework\Attributes\DataProvider;
use Throwable;

final class DefaultCarrierFactoryTest extends BaseTestCase
{
    /**
     * @param array<string,mixed> $data
     */
    #[DataProvider('providesTestCreateCollection')]
    public function testCreateCollection(array $data, CarrierCollection|Throwable $result): void
    {
        if ($result instanceof Throwable) {
            $this->expectException($result::class);
            $this->expectExceptionMessage($result->getMessage());
        }

        $factory = $this->newDefaultCarrierFactory();

        $collection = $factory->createCollection($data);

        self::assertEquals($result, $collection);
    }

    /**
     * @return iterable<array<string,mixed>>
     */
    public static function providesTestCreateCollection(): iterable
    {
        yield 'valid' => [
            'data'   => [
                'status'   => 200,
                'carriers' => [
                    [
                        'name'     => 'Česká pošta',
                        'slug'     => 'cp',
                        'endpoint' => 'https://api.balikobot.cz/cp',
                    ],
                    [
                        'name'     => 'PPL',
                        'slug'     => 'ppl',
                        'endpoint' => 'https://api.balikobot.cz/ppl',
                    ],
                    [
                        'name'     => 'Magyar Posta',
                        'slug'     => 'magyarposta',
                        'endpoint' => 'https://api.balikobot.cz/magyarposta',
                    ],
                ],
            ],
            'result' => new DefaultCarrierCollection([
                new DefaultCarrier(
                    'cp',
                    'Česká pošta',
                ),
                new DefaultCarrier(
                    'ppl',
                    'PPL',
                ),
                new DefaultCarrier(
                    'magyarposta',
                    'Magyar Posta',
                ),
            ]),
        ];
    }

    /**
     * @param array<string,mixed> $data
     */
    #[DataProvider('providesTestCreate')]
    public function testCreate(string $carrier, array $data, Carrier|Throwable $result): void
    {
        if ($result instanceof Throwable) {
            $this->expectException($result::class);
            $this->expectExceptionMessage($result->getMessage());
        }

        $factory = $this->newDefaultCarrierFactory();

        $collection = $factory->create($carrier, $data);

        self::assertEquals($result, $collection);
    }

    /**
     * @return iterable<array<string,mixed>>
     */
    public static function providesTestCreate(): iterable
    {
        yield 'valid' => [
            'carrier' => 'zasilkovna',
            'data'    => [
                'status'               => 200,
                'name'                 => 'Zásilkovna',
                'v2_methods_available' => true,
                'methods'              => [
                    [
                        'method'   => 'ADD',
                        'endpoint' => 'https://api.balikobot.cz/zasilkovna/add',
                    ],
                    [
                        'method'   => 'TRACKSTATUS',
                        'endpoint' => 'https://api.balikobot.cz/zasilkovna/trackstatus',
                    ],
                ],
                'v2_methods'           => [
                    [
                        'method'   => 'ADD',
                        'endpoint' => 'https://api.balikobot.cz/v2/zasilkovna/add',
                    ],
                    [
                        'method'   => 'DROP',
                        'endpoint' => 'https://api.balikobot.cz/v2/zasilkovna/drop',
                    ],
                ],
            ],
            'result'  => new DefaultCarrier(
                'zasilkovna',
                'Zásilkovna',
                [
                    'https://apiv2.balikobot.cz'    => new DefaultMethodCollection([
                        new DefaultMethod('ADD'),
                        new DefaultMethod('TRACKSTATUS'),
                    ]),
                    'https://apiv2.balikobot.cz/v2' => new DefaultMethodCollection([
                        new DefaultMethod('ADD'),
                        new DefaultMethod('DROP'),
                    ]),
                ],
            ),
        ];
    }

    private function newDefaultCarrierFactory(): DefaultCarrierFactory
    {
        return new DefaultCarrierFactory(new DefaultMethodFactory());
    }
}
