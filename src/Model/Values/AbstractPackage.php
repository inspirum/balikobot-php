<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Values;

use ArrayAccess;
use Inspirum\Balikobot\Model\Values\Package\CommonData;
use function array_key_exists;

/**
 * @implements \ArrayAccess<string,mixed>
 */
abstract class AbstractPackage implements ArrayAccess
{
    use CommonData;

    /**
     * Package data
     *
     * @var array<string,mixed>
     */
    private array $data;

    /**
     * Package constructor
     *
     * @param array<string,mixed> $data
     */
    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    /**
     * Determine if an item exists at an offset
     *
     * @param string $key
     *
     * @return bool
     */
    public function offsetExists(mixed $key): bool
    {
        return array_key_exists($key, $this->data);
    }

    /**
     * Get an item at a given offset
     *
     * @param string $key
     *
     * @return mixed
     */
    public function offsetGet(mixed $key): mixed
    {
        return $this->data[$key];
    }

    /**
     * Set the item at a given offset
     *
     * @param string $key
     * @param mixed  $value
     *
     * @return void
     */
    public function offsetSet(mixed $key, mixed $value): void
    {
        $this->data[$key] = $value;
    }

    /**
     * Unset the item at a given offset
     *
     * @param string $key
     *
     * @return void
     */
    public function offsetUnset(mixed $key): void
    {
        unset($this->data[$key]);
    }

    /**
     * Get the collection of packages as a plain array
     *
     * @return array<string,mixed>
     */
    public function toArray(): array
    {
        return $this->data;
    }
}
