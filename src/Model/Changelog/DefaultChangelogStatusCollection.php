<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Changelog;

use Inspirum\Arrayable\BaseListCollection;

/**
 * @extends \Inspirum\Arrayable\BaseListCollection<string,string,\Inspirum\Balikobot\Model\Changelog\ChangelogStatus>
 */
final class DefaultChangelogStatusCollection extends BaseListCollection implements ChangelogStatusCollection
{
    /** @inheritDoc */
    public function getStatuses(): array
    {
        return $this->getItems();
    }
}
