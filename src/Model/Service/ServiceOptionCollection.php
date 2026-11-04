<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Service;

use Inspirum\Arrayable\ListCollection;

/**
 * @extends \Inspirum\Arrayable\ListCollection<string,string,\Inspirum\Balikobot\Model\Service\ServiceOption>
 */
interface ServiceOptionCollection extends ListCollection
{
    /**
     * @return list<\Inspirum\Balikobot\Model\Service\ServiceOption>
     */
    public function getOptions(): array;
}
