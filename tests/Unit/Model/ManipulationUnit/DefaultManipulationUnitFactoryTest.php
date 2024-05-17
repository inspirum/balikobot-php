<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Model\ManipulationUnit;

use Inspirum\Balikobot\Model\ManipulationUnit\DefaultManipulationUnit;
use Inspirum\Balikobot\Model\ManipulationUnit\DefaultManipulationUnitCollection;
use Inspirum\Balikobot\Model\ManipulationUnit\DefaultManipulationUnitFactory;
use Inspirum\Balikobot\Model\ManipulationUnit\ManipulationUnitCollection;
use Inspirum\Balikobot\Tests\Unit\BaseTestCase;
use PHPUnit\Framework\Attributes\DataProvider;
use Throwable;

final class DefaultManipulationUnitFactoryTest extends BaseTestCase
{
    /**
     * @param array<string,mixed> $data
     */
    #[DataProvider('providesTestCreateCollection')]
    public function testCreateCollection(string $carrier, array $data, ManipulationUnitCollection|Throwable $result): void
    {
        if ($result instanceof Throwable) {
            $this->expectException($result::class);
            $this->expectExceptionMessage($result->getMessage());
        }

        $factory = $this->newDefaultManipulationUnitFactory();

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
            'data' => [
                'status' => 200,
                'units' => [
                    [
                        'name' => 'Balík',
                        'code' => 32,
                    ],
                    [
                        'name' => 'Bedna',
                        'code' => 33,
                    ],
                ],
            ],
            'result' => new DefaultManipulationUnitCollection(
                'ppl',
                [
                    new DefaultManipulationUnit(
                        '32',
                        'Balík',
                    ),
                    new DefaultManipulationUnit(
                        '33',
                        'Bedna',
                    ),
                ],
            ),
        ];
    }

    private function newDefaultManipulationUnitFactory(): DefaultManipulationUnitFactory
    {
        return new DefaultManipulationUnitFactory();
    }
}
