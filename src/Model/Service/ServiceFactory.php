<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Service;

interface ServiceFactory
{
    /**
     * @param array<string,mixed> $data
     */
    public function create(string $carrier, array $data): Service;

    /**
     * @param array<string,mixed> $data
     */
    public function createCollection(string $carrier, array $data): ServiceCollection;
}
