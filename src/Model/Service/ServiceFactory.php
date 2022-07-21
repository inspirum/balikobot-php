<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Service;

use Inspirum\Balikobot\Client\Request\Carrier;

interface ServiceFactory
{
    /**
     * @param array<string,mixed> $data
     */
    public function create(Carrier $carrier, array $data): Service;

    /**
     * @param array<string,mixed> $data
     */
    public function createCollection(Carrier $carrier, array $data): ServiceCollection;
}
