<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Status;

use Inspirum\Arrayable\ListCollection;
use Inspirum\Balikobot\Model\PerCarrierCollection;

/**
 * @extends \Inspirum\Arrayable\ListCollection<string,mixed,\Inspirum\Balikobot\Model\Status\Statuses>
 * @extends \Inspirum\Balikobot\Model\PerCarrierCollection<\Inspirum\Balikobot\Model\Status\Statuses>
 */
interface StatusesCollection extends ListCollection, PerCarrierCollection
{
    /**
     * @return list<\Inspirum\Balikobot\Model\Status\Statuses>
     */
    public function getStatuses(): array;
}
