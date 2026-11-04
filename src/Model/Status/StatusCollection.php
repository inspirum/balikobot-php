<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Status;

use Inspirum\Arrayable\ListCollection;
use Inspirum\Balikobot\Model\PerCarrierCollection;

/**
 * @extends \Inspirum\Arrayable\ListCollection<string,mixed,\Inspirum\Balikobot\Model\Status\Status>
 * @extends \Inspirum\Balikobot\Model\PerCarrierCollection<\Inspirum\Balikobot\Model\Status\Status>
 */
interface StatusCollection extends ListCollection, PerCarrierCollection
{
    /**
     * @return list<\Inspirum\Balikobot\Model\Status\Status>
     */
    public function getStatuses(): array;
}
