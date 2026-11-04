<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\TransportCost;

use Inspirum\Balikobot\Model\BaseCarrierCollection;
use RuntimeException;
use function array_map;

/**
 * @extends \Inspirum\Balikobot\Model\BaseCarrierCollection<string,mixed,\Inspirum\Balikobot\Model\TransportCost\TransportCost>
 */
final class DefaultTransportCostCollection extends BaseCarrierCollection implements TransportCostCollection
{
    /** @inheritDoc */
    public function getCosts(): array
    {
        return $this->getItems();
    }

    /**
     * @return list<string>
     */
    public function getBatchIds(): array
    {
        return array_map(static fn (TransportCost $transportCost) => $transportCost->getBatchId(), $this->getItems());
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
