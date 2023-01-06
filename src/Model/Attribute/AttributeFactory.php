<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Attribute;

interface AttributeFactory
{
    /**
     * @param array<string,mixed> $data
     */
    public function create(array $data): Attribute;

    /**
     * @param array<string,mixed> $data
     *
     * @return \Inspirum\Balikobot\Model\Attribute\AttributeCollection&array<\Inspirum\Balikobot\Model\Attribute\Attribute>
     */
    public function createCollection(string $carrier, array $data): AttributeCollection;
}
