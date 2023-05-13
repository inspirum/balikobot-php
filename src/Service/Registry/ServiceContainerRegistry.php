<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Service\Registry;

interface ServiceContainerRegistry
{
    /**
     * Get service container for given connection
     */
    public function get(?string $connection = null): ServiceContainer;
}
