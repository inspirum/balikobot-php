<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Changelog;

use Inspirum\Arrayable\BaseListCollection;

/**
 * @extends \Inspirum\Arrayable\BaseListCollection<string,mixed,\Inspirum\Balikobot\Model\Changelog\Changelog>
 */
final class DefaultChangelogCollection extends BaseListCollection implements ChangelogCollection
{
    public function getLatestVersion(): string
    {
        return $this->offsetGet(0)->getVersion();
    }

    /** @inheritDoc */
    public function getChangelogs(): array
    {
        return $this->getItems();
    }
}
