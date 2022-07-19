<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Changelog;

use Inspirum\Arrayable\BaseCollection;

/**
 * @extends \Inspirum\Arrayable\BaseCollection<string,mixed,int,\Inspirum\Balikobot\Model\Changelog\Changelog>
 */
final class ChangelogCollection extends BaseCollection
{
    public function getLatestVersion(): string
    {
        return $this->offsetGet(0)->version;
    }
}
