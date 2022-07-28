<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Changelog;

use Inspirum\Arrayable\Collection;

/**
 * @extends \Inspirum\Arrayable\Collection<string,mixed,int,\Inspirum\Balikobot\Model\Changelog\Changelog>
 */
interface ChangelogCollection extends Collection
{
    public function getLatestVersion(): string;

    /**
     * @return array<int,\Inspirum\Balikobot\Model\Changelog\Changelog>
     */
    public function getChangelogs(): array;
}
