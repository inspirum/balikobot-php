<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Changelog;

interface ChangelogFactory
{
    /**
     * @param array<string,mixed> $data
     */
    public function create(array $data): Changelog;

    /**
     * @param array<string,mixed> $data
     */
    public function createCollection(array $data): ChangelogCollection;
}
