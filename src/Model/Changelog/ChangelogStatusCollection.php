<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Changelog;

use Inspirum\Arrayable\Collection;

/**
 * @extends \Inspirum\Arrayable\Collection<string,string,int,\Inspirum\Balikobot\Model\Changelog\ChangelogStatus>
 */
interface ChangelogStatusCollection extends Collection
{
    /**
     * @return array<int,\Inspirum\Balikobot\Model\Changelog\ChangelogStatus>
     */
    public function getStatuses(): array;
}
