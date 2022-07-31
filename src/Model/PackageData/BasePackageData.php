<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\PackageData;

use Inspirum\Arrayable\BaseModel;
use Inspirum\Balikobot\Model\PackageData\Package\CommonData;
use function array_key_exists;

/**
 * @extends \Inspirum\Arrayable\BaseModel<string,mixed>
 */
abstract class BasePackageData extends BaseModel implements PackageData
{
    use CommonData;

    /**
     * @param array<string,mixed> $data
     */
    public function __construct(
        private array $data = [],
    ) {
    }

    /** @inheritDoc */
    public function getData(): array
    {
        return $this->data;
    }

    public function offsetExists(mixed $key): bool
    {
        return array_key_exists($key, $this->data);
    }

    public function offsetGet(mixed $key): mixed
    {
        return $this->data[$key];
    }

    public function offsetSet(mixed $key, mixed $value): void
    {
        $this->data[$key] = $value;
    }

    public function offsetUnset(mixed $key): void
    {
        unset($this->data[$key]);
    }

    /** @inheritDoc */
    public function __toArray(): array
    {
        return $this->data;
    }
}
