<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Attribute;

use Inspirum\Balikobot\Client\Request\Carrier;

interface AttributeFactory
{
    /**
     * @param array<string,mixed> $data
     */
    public function create(array $data): Attribute;

    /**
     * @param array<string,mixed> $data
     */
    public function createCollection(Carrier $carrier, array $data): AttributeCollection;
}
