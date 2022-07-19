<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Changelog;

use DateTimeImmutable;
use function array_map;

final class DefaultChangelogFactory implements ChangelogFactory
{
    /** @inheritDoc */
    public function create(array $data): Changelog
    {
        return new Changelog(
            $data['version'],
            new DateTimeImmutable($data['date']),
            $this->createStatusCollection($data),
        );
    }

    /** @inheritDoc */
    public function createCollection(array $data): ChangelogCollection
    {
        return new ChangelogCollection(
            array_map(fn(array $version): Changelog => $this->create($version), $data['versions']),
        );
    }

    /**
     * @param array<string,mixed> $data
     */
    private function createStatus(array $data): ChangelogStatus
    {
        return new ChangelogStatus(
            $data['name'],
            $data['description'],
        );
    }

    /**
     * @param array<string,mixed> $data
     */
    private function createStatusCollection(array $data): ChangelogStatusCollection
    {
        return new ChangelogStatusCollection(
            array_map(fn(array $change): ChangelogStatus => $this->createStatus($change), $data['changes'])
        );
    }
}
