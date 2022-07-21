<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Model\ManipulationUnit;

use Inspirum\Balikobot\Model\Carrier\Carrier;
use Inspirum\Balikobot\Model\ManipulationUnit\DefaultManipulationUnitFactory;
use Inspirum\Balikobot\Model\ManipulationUnit\ManipulationUnit;
use Inspirum\Balikobot\Model\ManipulationUnit\ManipulationUnitCollection;
use Inspirum\Balikobot\Tests\BaseTestCase;
use Throwable;

final class DefaultManipulationUnitFactoryTest extends BaseTestCase
{
    /**
     * @param array<string,mixed> $data
     *
     * @dataProvider providesTestCreateCollection
     */
    public function testCreateCollection(Carrier $carrier, array $data, ManipulationUnitCollection|Throwable $result): void
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
    public function providesTestCreateCollection(): iterable
    {
        yield 'valid' => [
            'carrier' => Carrier::from('ppl'),
            'data'    => [
                'status' => 200,
                'units'  => [
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
            'result'  => new ManipulationUnitCollection(
                Carrier::from('ppl'),
                [
                    new ManipulationUnit(
                        '32',
                        'Balík',
                    ),
                    new ManipulationUnit(
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
