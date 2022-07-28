<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Attribute;

use Inspirum\Arrayable\Collection;

/**
 * @extends \Inspirum\Arrayable\Collection<string,mixed,int,\Inspirum\Balikobot\Model\Attribute\Attribute>
 */
interface AttributeCollection extends Collection
{
    public function getCarrier(): string;

    /**
     * @return array<int,\Inspirum\Balikobot\Model\Attribute\Attribute>
     */
    public function getAttributes(): array;
}
