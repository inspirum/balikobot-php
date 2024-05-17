<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Model\Method;

use Inspirum\Balikobot\Model\Method\DefaultMethod;
use Inspirum\Balikobot\Model\Method\DefaultMethodCollection;
use Inspirum\Balikobot\Model\Method\DefaultMethodFactory;
use Inspirum\Balikobot\Model\Method\MethodCollection;
use Inspirum\Balikobot\Tests\Unit\BaseTestCase;
use PHPUnit\Framework\Attributes\DataProvider;
use Throwable;

final class DefaultMethodFactoryTest extends BaseTestCase
{
    /**
     * @param array<string,mixed> $data
     */
    #[DataProvider('providesTestCreateCollection')]
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
    public static function providesTestCreateCollection(): iterable
    {
        yield 'valid' => [
            'data' => [
                [
                    'method' => 'ADD',
                    'endpoint' => 'https://api.balikobot.cz/zasilkovna/add',
                ],
                [
                    'method' => 'TRACKSTATUS',
                    'endpoint' => 'https://api.balikobot.cz/zasilkovna/trackstatus',
                ],
            ],
            'result' => new DefaultMethodCollection([
                new DefaultMethod('ADD'),
                new DefaultMethod('TRACKSTATUS'),
            ]),
        ];
    }

    private function newDefaultMethodFactory(): DefaultMethodFactory
    {
        return new DefaultMethodFactory();
    }
}
