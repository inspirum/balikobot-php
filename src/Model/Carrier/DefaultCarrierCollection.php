<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Carrier;

use Inspirum\Arrayable\BaseListCollection;
use function array_map;
use function array_values;

/**
 * @extends \Inspirum\Arrayable\BaseListCollection<string,mixed,\Inspirum\Balikobot\Model\Carrier\Carrier>
 */
final class DefaultCarrierCollection extends BaseListCollection implements CarrierCollection
{
    /** @inheritDoc */
    public function getCarriers(): array
    {
        return $this->getItems();
    }

    /** @inheritDoc */
    public function getCarrierCodes(): array
    {
        return array_values(array_map(static fn (Carrier $carrier): string => $carrier->getCode(), $this->getCarriers()));
    }
}
