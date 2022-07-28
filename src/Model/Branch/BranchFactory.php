<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Branch;

use Iterator;

interface BranchFactory
{
    /**
     * @param array<string,mixed> $data
     */
    public function create(string $carrier, ?string $service, array $data): Branch;

    /**
     * @param array<string,mixed> $data
     *
     * @return \Iterator<\Inspirum\Balikobot\Model\Branch\Branch>
     */
    public function createIterator(string $carrier, ?string $service, array $data): Iterator;
}
