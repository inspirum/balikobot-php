<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Attribute;

use function array_map;
use function trim;

final class DefaultAttributeFactory implements AttributeFactory
{
    /** @inheritDoc */
    public function create(array $data): Attribute
    {
        return new DefaultAttribute(
            trim($data['name']),
            $data['data_type'],
            (string) $data['max_length'],
        );
    }

    /** @inheritDoc */
    public function createCollection(string $carrier, array $data): AttributeCollection
    {
        return new DefaultAttributeCollection(
            $carrier,
            array_map(fn (array $attribute): Attribute => $this->create($attribute), $data['attributes'] ?? []),
        );
    }
}
