<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Method;

use function array_map;

final class DefaultMethodFactory implements MethodFactory
{
    /**
     * @param array<string,string> $data
     */
    public function create(array $data): Method
    {
        return new Method($data['method']);
    }

    /**
     * @param array<array<string,string>> $data
     */
    public function createCollection(array $data): MethodCollection
    {
        return new MethodCollection(array_map(fn(array $method): Method => $this->create($method), $data));
    }
}
