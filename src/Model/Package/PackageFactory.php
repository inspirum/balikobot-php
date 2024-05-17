<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Package;

interface PackageFactory
{
    /**
     * @param array<string,mixed> $data
     */
    public function create(string $carrier, array $data): Package;

    /**
     * @param array<int,array<string,mixed>>|null $packages
     * @param array<string,mixed> $data
     *
     * @return \Inspirum\Balikobot\Model\Package\PackageCollection&array<\Inspirum\Balikobot\Model\Package\Package>
     *
     * @throws \Inspirum\Balikobot\Exception\Exception
     */
    public function createCollection(string $carrier, ?array $packages, array $data): PackageCollection;
}
