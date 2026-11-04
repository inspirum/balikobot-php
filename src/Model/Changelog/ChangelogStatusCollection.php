<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Changelog;

use Inspirum\Arrayable\ListCollection;

/**
 * @extends \Inspirum\Arrayable\ListCollection<string,string,\Inspirum\Balikobot\Model\Changelog\ChangelogStatus>
 */
interface ChangelogStatusCollection extends ListCollection
{
    /**
     * @return list<\Inspirum\Balikobot\Model\Changelog\ChangelogStatus>
     */
    public function getStatuses(): array;
}
