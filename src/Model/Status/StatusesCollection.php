<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Status;

use Inspirum\Arrayable\Collection;
use Inspirum\Balikobot\Model\PerCarrierCollection;

/**
 * @extends \Inspirum\Arrayable\Collection<string,mixed,int,\Inspirum\Balikobot\Model\Status\Statuses>
 * @extends \Inspirum\Balikobot\Model\PerCarrierCollection<\Inspirum\Balikobot\Model\Status\Statuses>
 */
interface StatusesCollection extends Collection, PerCarrierCollection
{
    /**
     * @return array<int,\Inspirum\Balikobot\Model\Status\Statuses>
     */
    public function getStatuses(): array;
}
