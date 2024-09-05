<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Provider;

interface ServiceProvider
{
    /**
     * @return list<string>
     */
    public function getServices(string $carrier): array;
}
