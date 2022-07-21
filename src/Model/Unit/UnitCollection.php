<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Unit;

use Inspirum\Arrayable\BaseCollection;
use Inspirum\Balikobot\Client\Request\Carrier;

/**
 * @extends \Inspirum\Arrayable\BaseCollection<string,mixed,int,\Inspirum\Balikobot\Model\Unit\Unit>
 */
final class UnitCollection extends BaseCollection
{
    /**
     * @param array<int,\Inspirum\Balikobot\Model\Unit\Unit> $items
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
