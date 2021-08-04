<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Aggregates;

use ArrayAccess;
use ArrayIterator;
use Countable;
use Inspirum\Balikobot\Model\Values\OrderedPackage;
use InvalidArgumentException;
use IteratorAggregate;
use RuntimeException;
use function array_key_exists;
use function array_map;
use function count;
use function sprintf;

/**
 * @implements \ArrayAccess<int,\Inspirum\Balikobot\Model\Values\OrderedPackage>
 * @implements \IteratorAggregate<int,\Inspirum\Balikobot\Model\Values\OrderedPackage>
 */
class OrderedPackageCollection implements ArrayAccess, Countable, IteratorAggregate
{
    /**
     * Packages
     *
     * @var array<int,\Inspirum\Balikobot\Model\Values\OrderedPackage>
     */
    private array $packages = [];

    /**
     * Shipper code
     *
     * @var string|null
     */
    private ?string $shipper;

    /**
     * Labels URL
     *
     * @var string|null
     */
    private ?string $labelsUrl = null;

    /**
     * OrderedPackageCollection constructor
     *
     * @param string|null $shipper
     */
    public function __construct(?string $shipper = null)
    {
        $this->shipper = $shipper;
    }

    /**
     * Add package
     *
     * @param \Inspirum\Balikobot\Model\Values\OrderedPackage $package
     *
     * @return void
     *
     * @throws \InvalidArgumentException
     */
    public function add(OrderedPackage $package): void
    {
        // validate package shipper
        $this->validateShipper($package);

        // add package to collection
        $this->packages[] = $package;
    }

    /**
     * Get shipper
     *
     * @return string
     */
    public function getShipper(): string
    {
        if ($this->shipper === null) {
            throw new RuntimeException('Collection is empty');
        }

        return $this->shipper;
    }

    /**
     * Get package IDs
     *
     * @return array<string>
     */
    public function getPackageIds(): array
    {
        return array_map(static fn(OrderedPackage $package) => $package->getPackageId(), $this->packages);
    }

    /**
     * Get carrier IDs
     *
     * @return array<string>
     */
    public function getCarrierIds(): array
    {
        return array_map(static fn(OrderedPackage $package) => $package->getCarrierId(), $this->packages);
    }

    /**
     * @param string|null $labelsUrl
     *
     * @return void
     */
    public function setLabelsUrl(?string $labelsUrl): void
    {
        $this->labelsUrl = $labelsUrl;
    }

    /**
     * @return string|null
     */
    public function getLabelsUrl(): ?string
    {
        return $this->labelsUrl;
    }

    /**
     * Validate shipper
     *
     * @param \Inspirum\Balikobot\Model\Values\OrderedPackage $package
     *
     * @return void
     *
     * @throws \InvalidArgumentException
     */
    private function validateShipper(OrderedPackage $package): void
    {
        // set shipper if first package in collection
        if ($this->shipper === null) {
            $this->shipper = $package->getShipper();
        }

        // validate shipper
        if ($this->shipper !== $package->getShipper()) {
            throw new InvalidArgumentException(
                sprintf(
                    'Package is from different shipper ("%s" instead of "%s")',
                    $package->getShipper(),
                    $this->shipper
                )
            );
        }
    }

    /**
     * Determine if an item exists at an offset
     *
     * @param int $key
     *
     * @return bool
     */
    public function offsetExists(mixed $key): bool
    {
        return array_key_exists($key, $this->packages);
    }

    /**
     * Get an item at a given offset
     *
     * @param int $key
     *
     * @return \Inspirum\Balikobot\Model\Values\OrderedPackage
     */
    public function offsetGet(mixed $key): OrderedPackage
    {
        return $this->packages[$key];
    }

    /**
     * Set the item at a given offset
     *
     * @param int                                             $key
     * @param \Inspirum\Balikobot\Model\Values\OrderedPackage $value
     *
     * @return void
     */
    public function offsetSet(mixed $key, mixed $value): void
    {
        $this->validateShipper($value);

        $this->packages[$key] = $value;
    }

    /**
     * Unset the item at a given offset
     *
     * @param int $key
     *
     * @return void
     */
    public function offsetUnset(mixed $key): void
    {
        unset($this->packages[$key]);
    }

    /**
     * Count elements of an object
     *
     * @return int
     */
    public function count(): int
    {
        return count($this->packages);
    }

    /**
     * Get an iterator for the items
     *
     * @return \ArrayIterator<int,\Inspirum\Balikobot\Model\Values\OrderedPackage>
     */
    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->packages);
    }
}
