<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\AdrUnit;

use Inspirum\Arrayable\BaseCollection;

/**
 * @extends \Inspirum\Arrayable\BaseCollection<string,mixed,int,\Inspirum\Balikobot\Model\AdrUnit\AdrUnit>
 */
final class DefaultAdrUnitCollection extends BaseCollection implements AdrUnitCollection
{
    /**
     * @param array<int,\Inspirum\Balikobot\Model\AdrUnit\AdrUnit> $items
     */
    public function __construct(
        private string $carrier,
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
