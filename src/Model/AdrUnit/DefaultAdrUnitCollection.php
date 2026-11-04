<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\AdrUnit;

use Inspirum\Arrayable\BaseListCollection;

/**
 * @extends \Inspirum\Arrayable\BaseListCollection<string,mixed,\Inspirum\Balikobot\Model\AdrUnit\AdrUnit>
 */
final class DefaultAdrUnitCollection extends BaseListCollection implements AdrUnitCollection
{
    /**
     * @param array<\Inspirum\Balikobot\Model\AdrUnit\AdrUnit> $items
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
