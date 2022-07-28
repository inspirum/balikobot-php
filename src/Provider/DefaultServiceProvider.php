<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Provider;

use Inspirum\Balikobot\Definitions\ServiceType;

final class DefaultServiceProvider implements ServiceProvider
{
    /** @inheritDoc */
    public function getServices(string $carrier): array
    {
        return ServiceType::all()[$carrier] ?? [];
    }
}
