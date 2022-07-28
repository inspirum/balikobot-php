<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Carrier;

use Inspirum\Arrayable\Collection;

/**
 * @extends \Inspirum\Arrayable\Collection<string,mixed,int,\Inspirum\Balikobot\Model\Carrier\Carrier>
 */
interface CarrierCollection extends Collection
{
    /**
     * @return array<int,\Inspirum\Balikobot\Model\Carrier\Carrier>
     */
    public function getCarriers(): array;
}
