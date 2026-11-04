<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Service;

use Inspirum\Arrayable\BaseListCollection;

/**
 * @extends \Inspirum\Arrayable\BaseListCollection<string,string,\Inspirum\Balikobot\Model\Service\ServiceOption>
 */
final class DefaultServiceOptionCollection extends BaseListCollection implements ServiceOptionCollection
{
    /** @inheritDoc */
    public function getOptions(): array
    {
        return $this->getItems();
    }
}
