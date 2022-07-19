<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\PackageData;

use ArrayAccess;
use Inspirum\Arrayable\BaseModel;
use Inspirum\Balikobot\Model\PackageData\Package\CommonData;
use function array_key_exists;

/**
 * @extends \Inspirum\Arrayable\BaseModel<string,mixed>
 * @implements \ArrayAccess<string,mixed>
 */
abstract class BasePackage extends BaseModel implements ArrayAccess
{
    use CommonData;

    /**
     * @param array<string,mixed> $data
     */
    public function __construct(private array $data = [])
    {
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

    /**
     * @return array<string,mixed>
     */
    public function __toArray(): array
    {
        return $this->data;
    }
}
