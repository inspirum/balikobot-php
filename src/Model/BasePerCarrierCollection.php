<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model;

use function array_map;

/**
 * @template TItemKey of array-key
 * @template TItemValue
 * @template TValue of \Inspirum\Arrayable\Arrayable<TItemKey,TItemValue>&\Inspirum\Balikobot\Model\WithCarrierId
 * @extends \Inspirum\Balikobot\Model\BaseCarrierCollection<TItemKey,TItemValue,TValue>
 * @implements \Inspirum\Balikobot\Model\PerCarrierCollection<TValue>
 */
abstract class BasePerCarrierCollection extends BaseCarrierCollection implements PerCarrierCollection
{
    /**
     * @param TValue $item
     *
     * @throws \InvalidArgumentException
     */
    public function add(WithCarrierId $item): void
    {
        $this->offsetAdd($item);
    }

    /**
     * @return TValue|null
     */
    public function getForCarrierId(string $carrierId): ?WithCarrierId
    {
        return $this->first(static fn (WithCarrierId $item) => $item->getCarrierId() === $carrierId);
    }

    /**
     * @param callable(TValue): bool $filter
     *
     * @return TValue|null
     */
    protected function first(callable $filter): ?WithCarrierId
    {
        foreach ($this->items as $package) {
            if ($filter($package)) {
                return $package;
            }
        }

        return null;
    }

    /** @inheritDoc */
    public function getCarrierIds(): array
    {
        return array_map(static fn (WithCarrierId $item) => $item->getCarrierId(), $this->getItems());
    }
}
