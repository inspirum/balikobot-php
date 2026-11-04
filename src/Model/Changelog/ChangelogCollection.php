<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Changelog;

use Inspirum\Arrayable\ListCollection;

/**
 * @extends \Inspirum\Arrayable\ListCollection<string,mixed,\Inspirum\Balikobot\Model\Changelog\Changelog>
 */
interface ChangelogCollection extends ListCollection
{
    public function getLatestVersion(): string;

    /**
     * @return list<\Inspirum\Balikobot\Model\Changelog\Changelog>
     */
    public function getChangelogs(): array;
}
