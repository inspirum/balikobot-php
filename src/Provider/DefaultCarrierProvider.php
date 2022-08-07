<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Provider;

use Inspirum\Balikobot\Definitions\Carrier;

final class DefaultCarrierProvider implements CarrierProvider
{
    /** @inheritDoc */
    public function getCarriers(): array
    {
        return Carrier::getAll();
    }
}
