<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Attribute;

use Inspirum\Arrayable\BaseCollection;
use Inspirum\Balikobot\Client\Request\Carrier;

/**
 * @extends \Inspirum\Arrayable\BaseCollection<string,mixed,int,\Inspirum\Balikobot\Model\Attribute\Attribute>
 */
final class AttributeCollection extends BaseCollection
{
    /**
     * @param array<int,\Inspirum\Balikobot\Model\Attribute\Attribute> $items
     */
    public function __construct(
        private Carrier $carrier,
        array $items = [],
    ) {
        parent::__construct($items);
    }

    public function getCarrier(): Carrier
    {
        return $this->carrier;
    }
}
