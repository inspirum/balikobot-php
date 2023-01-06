<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Status;

use Inspirum\Arrayable\Model;
use Inspirum\Balikobot\Model\WithCarrierId;

/**
 * @extends \Inspirum\Arrayable\Model<string,mixed>
 */
interface Statuses extends Model, WithCarrierId
{
    /**
     * @return \Inspirum\Balikobot\Model\Status\StatusCollection&array<\Inspirum\Balikobot\Model\Status\Status>
     */
    public function getStates(): StatusCollection;
}
