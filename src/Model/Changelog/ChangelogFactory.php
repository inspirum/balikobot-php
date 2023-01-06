<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Changelog;

interface ChangelogFactory
{
    /**
     * @param array<string,mixed> $data
     *
     * @throws \Exception
     */
    public function create(array $data): Changelog;

    /**
     * @param array<string,mixed> $data
     *
     * @return \Inspirum\Balikobot\Model\Changelog\ChangelogCollection&array<\Inspirum\Balikobot\Model\Changelog\Changelog>
     *
     * @throws \Exception
     */
    public function createCollection(array $data): ChangelogCollection;
}
