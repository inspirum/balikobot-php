<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\PackageData;

interface PackageDataFactory
{
    /**
     * @param array<string,mixed> $data
     */
    public function create(array $data): PackageData;
}
