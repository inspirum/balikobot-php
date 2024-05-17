<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\TransportCost;

use Inspirum\Arrayable\BaseCollection;
use RuntimeException;
use function array_map;

/**
 * @extends \Inspirum\Arrayable\BaseCollection<string,mixed,int,\Inspirum\Balikobot\Model\TransportCost\TransportCost>
 */
final class DefaultTransportCostCollection extends BaseCollection implements TransportCostCollection
{
    /**
     * @param array<int,\Inspirum\Balikobot\Model\TransportCost\TransportCost> $items
     */
    public function __construct(
        private readonly ?string $carrier,
        array $items = [],
    ) {
        parent::__construct($items);
    }

    public function getCarrier(): string
    {
        return $this->carrier ?? throw new RuntimeException('Collection is empty');
    }

    /** @inheritDoc */
    public function getCosts(): array
    {
        return $this->getItems();
    }

    /**
     * @return array<string>
     */
    public function getBatchIds(): array
    {
        return array_map(static fn(TransportCost $transportCost) => $transportCost->getBatchId(), $this->getItems());
    }

    public function getTotalCost(): float
    {
        $totalCost = 0.0;
        $currencyCode = $this->getCurrencyCode();

        foreach ($this->getItems() as $cost) {
            if ($cost->getCurrencyCode() !== $currencyCode) {
                throw new RuntimeException('Package cost currency codes are not the same');
            }

            $totalCost += $cost->getTotalCost();
        }

        return $totalCost;
    }

    public function getCurrencyCode(): string
    {
        if (empty($this->items)) {
            throw new RuntimeException('Collection is empty');
        }

        return $this->items[0]->getCurrencyCode();
    }
}
