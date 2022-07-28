<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Changelog;

use Inspirum\Arrayable\BaseCollection;

/**
 * @extends \Inspirum\Arrayable\BaseCollection<string,string,int,\Inspirum\Balikobot\Model\Changelog\ChangelogStatus>
 */
final class DefaultChangelogStatusCollection extends BaseCollection implements ChangelogStatusCollection
{
    /** @inheritDoc */
    public function getStatuses(): array
    {
        return $this->getItems();
    }
}
