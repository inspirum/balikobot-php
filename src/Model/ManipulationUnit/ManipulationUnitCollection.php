<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\ManipulationUnit;

use Inspirum\Arrayable\BaseCollection;
use Inspirum\Balikobot\Client\Request\Carrier;

/**
 * @extends \Inspirum\Arrayable\BaseCollection<string,mixed,int,\Inspirum\Balikobot\Model\ManipulationUnit\ManipulationUnit>
 */
final class ManipulationUnitCollection extends BaseCollection
{
    /**
     * @param array<int,\Inspirum\Balikobot\Model\ManipulationUnit\ManipulationUnit> $items
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
