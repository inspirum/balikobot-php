<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Carrier;

use Inspirum\Arrayable\BaseCollection;
use function array_map;

/**
 * @extends \Inspirum\Arrayable\BaseCollection<string,mixed,int,\Inspirum\Balikobot\Model\Carrier\Carrier>
 */
final class DefaultCarrierCollection extends BaseCollection implements CarrierCollection
{
    /** @inheritDoc */
    public function getCarriers(): array
    {
        return $this->getItems();
    }

    /** @inheritDoc */
    public function getCarrierCodes(): array
    {
        return array_map(static fn(Carrier $carrier): string => $carrier->getCode(), $this->getCarriers());
    }
}
