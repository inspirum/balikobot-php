<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Status;

use Inspirum\Arrayable\Collection;
use Inspirum\Balikobot\Model\WithCarrierId;

/**
 * @extends \Inspirum\Arrayable\Collection<string,mixed,int,\Inspirum\Balikobot\Model\Status\Status>
 */
interface Statuses extends Collection, WithCarrierId
{
    /**
     * @return array<\Inspirum\Balikobot\Model\Status\Status>
     */
    public function getStates(): array;
}
