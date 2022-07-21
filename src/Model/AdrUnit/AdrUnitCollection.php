<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\AdrUnit;

use Inspirum\Arrayable\BaseCollection;
use Inspirum\Balikobot\Client\Request\Carrier;

/**
 * @extends \Inspirum\Arrayable\BaseCollection<string,mixed,int,\Inspirum\Balikobot\Model\AdrUnit\AdrUnit>
 */
final class AdrUnitCollection extends BaseCollection
{
    /**
     * @param array<int,\Inspirum\Balikobot\Model\AdrUnit\AdrUnit> $items
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
