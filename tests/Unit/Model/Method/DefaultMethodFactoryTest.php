<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Model\Method;

use Inspirum\Balikobot\Model\Method\DefaultMethodFactory;
use Inspirum\Balikobot\Model\Method\Method;
use Inspirum\Balikobot\Model\Method\MethodCollection;
use Inspirum\Balikobot\Tests\BaseTestCase;
use Throwable;

final class DefaultMethodFactoryTest extends BaseTestCase
{
    /**
     * @param array<string,mixed> $data
     *
     * @dataProvider providesTestCreateCollection
     */
    public function testCreateCollection(array $data, MethodCollection|Throwable $result): void
    {
        if ($result instanceof Throwable) {
            $this->expectException($result::class);
            $this->expectExceptionMessage($result->getMessage());
        }

        $factory = $this->newDefaultMethodFactory();

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
                [
                    'method'   => 'ADD',
                    'endpoint' => 'https://api.balikobot.cz/zasilkovna/add',
                ],
                [
                    'method'   => 'TRACKSTATUS',
                    'endpoint' => 'https://api.balikobot.cz/zasilkovna/trackstatus',
                ],
            ],
            'result'  =>  new MethodCollection([
                new Method('ADD'),
                new Method('TRACKSTATUS'),
            ]),
        ];
    }

    private function newDefaultMethodFactory(): DefaultMethodFactory
    {
        return new DefaultMethodFactory();
    }
}
