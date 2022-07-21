<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Package;

use Inspirum\Balikobot\Client\Request\Carrier;

interface PackageFactory
{
    /**
     * @param array<string,mixed> $data
     */
    public function create(Carrier $carrier, array $data): Package;

    /**
     * @param array<int, array<string,mixed>>|null $packages
     * @param array<string,mixed>                  $data
     */
    public function createCollection(Carrier $carrier, ?array $packages, array $data): PackageCollection;
}
