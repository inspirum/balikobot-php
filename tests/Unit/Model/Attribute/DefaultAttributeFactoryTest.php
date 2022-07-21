<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Model\Attribute;

use Inspirum\Balikobot\Model\Attribute\Attribute;
use Inspirum\Balikobot\Model\Attribute\AttributeCollection;
use Inspirum\Balikobot\Model\Attribute\DefaultAttributeFactory;
use Inspirum\Balikobot\Model\Carrier\Carrier;
use Inspirum\Balikobot\Tests\BaseTestCase;
use Throwable;

final class DefaultAttributeFactoryTest extends BaseTestCase
{
    /**
     * @param array<string,mixed> $data
     *
     * @dataProvider providesTestCreateCollection
     */
    public function testCreateCollection(Carrier $carrier, array $data, AttributeCollection|Throwable $result): void
    {
        if ($result instanceof Throwable) {
            $this->expectException($result::class);
            $this->expectExceptionMessage($result->getMessage());
        }

        $factory = $this->newDefaultUnitFactory();

        $collection = $factory->createCollection($carrier, $data);

        self::assertEquals($result, $collection);
    }

    /**
     * @return iterable<array<string,mixed>>
     */
    public function providesTestCreateCollection(): iterable
    {
        yield 'valid' => [
            'carrier' => Carrier::from('cp'),
            'data'    => [
                'status' => 200,
                'attributes' => [
                    [
                        'name'       => 'eid',
                        'data_type'  => 'string',
                        'max_length' => 40,
                    ],
                    [
                        'name'       => 'services',
                        'data_type'  => 'plus_separated_values',
                        'max_length' => null,
                    ],
                    [
                        'name'       => 'volume',
                        'data_type'  => 'float',
                        'max_length' => '9.20',
                    ],
                ],
            ],
            'result'  => new AttributeCollection(
                Carrier::from('cp'),
                [
                    new Attribute(
                        'eid',
                        'string',
                        '40',
                    ),
                    new Attribute(
                        'services',
                        'plus_separated_values',
                        null,
                    ),
                    new Attribute(
                        'volume',
                        'float',
                        '9.20',
                    ),
                ],
            ),
        ];
    }

    private function newDefaultUnitFactory(): DefaultAttributeFactory
    {
        return new DefaultAttributeFactory();
    }
}
