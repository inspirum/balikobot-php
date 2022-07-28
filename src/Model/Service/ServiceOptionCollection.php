<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Service;

use Inspirum\Arrayable\Collection;

/**
 * @extends \Inspirum\Arrayable\Collection<string,string,int,\Inspirum\Balikobot\Model\Service\ServiceOption>
 */
interface ServiceOptionCollection extends Collection
{
    /**
     * @return array<int,\Inspirum\Balikobot\Model\Service\ServiceOption>
     */
    public function getOptions(): array;
}
