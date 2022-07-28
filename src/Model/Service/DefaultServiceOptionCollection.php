<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Service;

use Inspirum\Arrayable\BaseCollection;

/**
 * @extends \Inspirum\Arrayable\BaseCollection<string,string,int,\Inspirum\Balikobot\Model\Service\ServiceOption>
 */
final class DefaultServiceOptionCollection extends BaseCollection implements ServiceOptionCollection
{
    /** @inheritDoc */
    public function getOptions(): array
    {
        return $this->getItems();
    }
}
