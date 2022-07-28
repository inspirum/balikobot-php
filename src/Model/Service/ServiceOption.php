<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Service;

use Inspirum\Arrayable\Model;

/**
 * @extends \Inspirum\Arrayable\Model<string,string>
 */
interface ServiceOption extends Model
{
    public function getCode(): string;

    public function getName(): string;
}
