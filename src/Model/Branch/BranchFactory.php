<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Branch;

use Traversable;

interface BranchFactory
{
    /**
     * @param array<string,mixed> $data
     */
    public function create(string $carrier, ?string $service, array $data): Branch;

    /**
     * @param array<string>       $countries
     * @param array<string,mixed> $data
     *
     * @return \Inspirum\Balikobot\Model\Branch\BranchIterator&iterable<\Inspirum\Balikobot\Model\Branch\Branch>
     */
    public function createIterator(string $carrier, ?string $service, ?array $countries, array $data): BranchIterator;

    /**
     * @param array<string>                                         $countries
     * @param \Traversable<\Inspirum\Balikobot\Model\Branch\Branch> $iterator
     *
     * @return \Inspirum\Balikobot\Model\Branch\BranchIterator&iterable<\Inspirum\Balikobot\Model\Branch\Branch>
     */
    public function wrapIterator(?string $carrier, ?string $service, ?array $countries, Traversable $iterator): BranchIterator;
}
