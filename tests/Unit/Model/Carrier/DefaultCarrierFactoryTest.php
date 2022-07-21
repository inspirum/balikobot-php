<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Model\Carrier;

use Inspirum\Balikobot\Model\Carrier\Carrier;
use Inspirum\Balikobot\Model\Carrier\CarrierCollection;
use Inspirum\Balikobot\Model\Carrier\DefaultCarrierFactory;
use Inspirum\Balikobot\Model\Method\DefaultMethodFactory;
use Inspirum\Balikobot\Model\Method\Method;
use Inspirum\Balikobot\Model\Method\MethodCollection;
use Inspirum\Balikobot\Tests\BaseTestCase;
use Throwable;

final class DefaultCarrierFactoryTest extends BaseTestCase
{
    /**
     * @param array<string,mixed> $data
     *
     * @dataProvider providesTestCreateCollection
     */
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
    public function providesTestCreateCollection(): iterable
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
            'result' => new CarrierCollection([
                new Carrier(
                    'cp',
                    'Česká pošta',
                ),
                new Carrier(
                    'ppl',
                    'PPL',
                ),
                new Carrier(
                    'magyarposta',
                    'Magyar Posta',
                ),
            ]),
        ];
    }

    /**
     * @param array<string,mixed> $data
     *
     * @dataProvider providesTestCreate
     */
    public function testCreate(Carrier $carrier, array $data, Carrier|Throwable $result): void
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
    public function providesTestCreate(): iterable
    {
        yield 'valid' => [
            'carrier' => Carrier::from('zasilkovna'),
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
            'result'  => new Carrier(
                'zasilkovna',
                'Zásilkovna',
                [
                    'https://apiv2.balikobot.cz'    => new MethodCollection([
                        new Method('ADD'),
                        new Method('TRACKSTATUS'),
                    ]),
                    'https://apiv2.balikobot.cz/v2' => new MethodCollection([
                        new Method('ADD'),
                        new Method('DROP'),
                    ]),
                ]
            ),
        ];
    }

    private function newDefaultCarrierFactory(): DefaultCarrierFactory
    {
        return new DefaultCarrierFactory(new DefaultMethodFactory());
    }
}
