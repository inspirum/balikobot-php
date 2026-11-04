<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Attribute;

use Inspirum\Arrayable\ListCollection;

/**
 * @extends \Inspirum\Arrayable\ListCollection<string,mixed,\Inspirum\Balikobot\Model\Attribute\Attribute>
 */
interface AttributeCollection extends ListCollection
{
    public function getCarrier(): string;

    /**
     * @return list<\Inspirum\Balikobot\Model\Attribute\Attribute>
     */
    public function getAttributes(): array;
}
