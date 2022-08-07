<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Provider;

use Inspirum\Balikobot\Definitions\Service;

final class DefaultServiceProvider implements ServiceProvider
{
    /** @inheritDoc */
    public function getServices(string $carrier): array
    {
        return Service::getForCarrier($carrier) ?? [];
    }
}
