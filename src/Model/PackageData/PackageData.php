<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\PackageData;

use ArrayAccess;
use Inspirum\Arrayable\Model;

/**
 * @extends \Inspirum\Arrayable\Model<string,mixed>
 * @extends \ArrayAccess<string,mixed>
 */
interface PackageData extends Model, ArrayAccess
{
    /**
     * @return array<string,mixed>
     */
    public function getData(): array;

    public function setEID(string $id): void;

    public function getEID(): ?string;

    public function hasEID(): bool;
}
