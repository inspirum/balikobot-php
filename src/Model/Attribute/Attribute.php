<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Attribute;

use Inspirum\Arrayable\Model;

/**
 * @extends \Inspirum\Arrayable\Model<string,mixed>
 */
interface Attribute extends Model
{
    public function getName(): string;

    public function getDataType(): string;

    public function getMaxLength(): ?string;
}
