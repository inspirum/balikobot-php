<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Method;

use function array_map;
use function array_values;

final class DefaultMethodFactory implements MethodFactory
{
    /** @inheritDoc */
    public function create(array $data): Method
    {
        return new DefaultMethod($data['method']);
    }

    /** @inheritDoc */
    public function createCollection(array $data): MethodCollection
    {
        return new DefaultMethodCollection(array_values(array_map(fn (array $method): Method => $this->create($method), $data)));
    }
}
