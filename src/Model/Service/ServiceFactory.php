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
     *
     * @return \Inspirum\Balikobot\Model\Service\ServiceCollection&array<\Inspirum\Balikobot\Model\Service\Service>
     */
    public function createCollection(string $carrier, array $data): ServiceCollection;
}
