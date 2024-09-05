<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Carrier;

use Inspirum\Arrayable\ListCollection;

/**
 * @extends \Inspirum\Arrayable\ListCollection<string,mixed,\Inspirum\Balikobot\Model\Carrier\Carrier>
 */
interface CarrierCollection extends ListCollection
{
    /**
     * @return list<\Inspirum\Balikobot\Model\Carrier\Carrier>
     */
    public function getCarriers(): array;

    /**
     * @return list<string>
     */
    public function getCarrierCodes(): array;
}
