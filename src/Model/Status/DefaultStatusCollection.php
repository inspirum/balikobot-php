<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Status;

use Inspirum\Balikobot\Model\BasePerCarrierCollection;

/**
 * @extends \Inspirum\Balikobot\Model\BasePerCarrierCollection<string,mixed,\Inspirum\Balikobot\Model\Status\Status>
 */
final class DefaultStatusCollection extends BasePerCarrierCollection implements StatusCollection
{
    /** @inheritDoc */
    public function getStatuses(): array
    {
        return $this->getItems();
    }
}
