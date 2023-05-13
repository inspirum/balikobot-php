<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Service\Registry;

use Inspirum\Balikobot\Exception\ServiceContainerNotFoundException;
use function array_keys;

final class DefaultServiceContainerRegistry implements ServiceContainerRegistry
{
    /**
     * @param array<string, \Inspirum\Balikobot\Service\Registry\ServiceContainer> $containers
     */
    public function __construct(
        private array $containers = [],
        private string $defaultConnectionName = 'default',
    ) {
    }

    public function add(string $connection, ServiceContainer $container): void
    {
        $this->containers[$connection] = $container;
    }

    public function get(?string $connection = null): ServiceContainer
    {
        $connection ??= $this->defaultConnectionName;

        return $this->containers[$connection] ?? throw new ServiceContainerNotFoundException($connection, array_keys($this->containers));
    }
}
