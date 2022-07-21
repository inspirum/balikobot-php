<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\TransportCost;

use Inspirum\Arrayable\BaseCollection;
use Inspirum\Balikobot\Client\Request\Carrier;
use RuntimeException;
use function array_map;

/**
 * @extends \Inspirum\Arrayable\BaseCollection<string,mixed,int,\Inspirum\Balikobot\Model\TransportCost\TransportCost>
 */
class TransportCostCollection extends BaseCollection
{
    public function __construct(
        private ?Carrier $carrier,
    ) {
        parent::__construct([]);
    }

    public function getCarrier(): Carrier
    {
        return $this->carrier ?? throw new RuntimeException('Collection is empty');
    }

    /**
     * @return array<string>
     */
    public function getBatchIds(): array
    {
        return array_map(static fn(TransportCost $transportCost) => $transportCost->batchId, $this->items);
    }

    public function getTotalCost(): float
    {
        $totalCost    = 0.0;
        $currencyCode = $this->getCurrencyCode();

        foreach ($this->getItems() as $cost) {
            if ($cost->currencyCode !== $currencyCode) {
                throw new RuntimeException('Package cost currency codes are not the same');
            }

            $totalCost += $cost->totalCost;
        }

        return $totalCost;
    }

    public function getCurrencyCode(): string
    {
        if (empty($this->costs)) {
            throw new RuntimeException('Collection is empty');
        }

        return $this->costs[0]->currencyCode;
    }
}
