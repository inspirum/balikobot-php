<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Attribute;

use Inspirum\Balikobot\Client\Request\Carrier;
use function array_map;

final class DefaultAttributeFactory implements AttributeFactory
{
    /** @inheritDoc */
    public function create(array $data): Attribute
    {
        return new Attribute(
            $data['name'],
            $data['data_type'],
            $data['max_length'],
        );
    }

    /** @inheritDoc */
    public function createCollection(Carrier $carrier, array $data): AttributeCollection
    {
        return new AttributeCollection(
            $carrier,
            array_map(fn(array $attribute): Attribute => $this->create($attribute), $data['attributes'] ?? []),
        );
    }
}
