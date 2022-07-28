<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Carrier;

use Inspirum\Arrayable\BaseCollection;

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
}
