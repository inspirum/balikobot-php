<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\ManipulationUnit;

use Inspirum\Arrayable\BaseCollection;

/**
 * @extends \Inspirum\Arrayable\BaseCollection<string,mixed,int,\Inspirum\Balikobot\Model\ManipulationUnit\ManipulationUnit>
 */
final class DefaultManipulationUnitCollection extends BaseCollection implements ManipulationUnitCollection
{
    /**
     * @param array<int,\Inspirum\Balikobot\Model\ManipulationUnit\ManipulationUnit> $items
     */
    public function __construct(
        private readonly string $carrier,
        array $items = [],
    ) {
        parent::__construct($items);
    }

    public function getCarrier(): string
    {
        return $this->carrier;
    }

    /** @inheritDoc */
    public function getUnits(): array
    {
        return $this->getItems();
    }
}
