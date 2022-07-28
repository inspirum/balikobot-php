<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Method;

use Inspirum\Arrayable\Model;

/**
 * @extends \Inspirum\Arrayable\Model<string,mixed>
 */
interface Method extends Model, \Inspirum\Balikobot\Client\Request\Method
{
    public function getCode(): string;
}
