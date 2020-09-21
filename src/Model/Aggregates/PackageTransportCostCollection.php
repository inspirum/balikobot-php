<?php

namespace Inspirum\Balikobot\Model\Aggregates;

use ArrayAccess;
use ArrayIterator;
use Countable;
use Inspirum\Balikobot\Model\Values\PackageTransportCost;
use InvalidArgumentException;
use IteratorAggregate;
use RuntimeException;

/**
 * @implements \ArrayAccess<int,\Inspirum\Balikobot\Model\Values\PackageTransportCost>
 * @implements \IteratorAggregate<int,\Inspirum\Balikobot\Model\Values\PackageTransportCost>
 */
class PackageTransportCostCollection implements ArrayAccess, Countable, IteratorAggregate
{
    /**
     * Package costs
     *
     * @var array<int,\Inspirum\Balikobot\Model\Values\PackageTransportCost>|\Inspirum\Balikobot\Model\Values\PackageTransportCost[]
     */
    private $costs = [];

    /**
     * Shipper code
     *
     * @var string|null
     */
    private $shipper;

    /**
     * OrderedPackageCollection constructor
     *
     * @param string|null $shipper
     */
    public function __construct(string $shipper = null)
    {
        $this->shipper = $shipper;
    }

    /**
     * Add package cost
     *
     * @param \Inspirum\Balikobot\Model\Values\PackageTransportCost $package
     *
     * @return void
     *
     * @throws \InvalidArgumentException
     */
    public function add(PackageTransportCost $package): void
    {
        // validate package cost shipper
        $this->validateShipper($package);

        // add package cost to collection
        $this->costs[] = $package;
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
     * Get EIDs
     *
     * @return array<int>
     */
    public function getBatchIds(): array
    {
        return array_map(function (PackageTransportCost $transportCost) {
            return $transportCost->getBatchId();
        }, $this->costs);
    }

    /**
     * Get total cost for all packages
     *
     * @return float
     */
    public function getTotalCost(): float
    {
        $totalCost    = 0.0;
        $currencyCode = $this->getCurrencyCode();

        foreach ($this->costs as $cost) {
            if ($cost->getCurrencyCode() !== $currencyCode) {
                throw new RuntimeException('Package cost currency codes are not the same');
            }

            $totalCost += $cost->getTotalCost();
        }

        return $totalCost;
    }

    /**
     * Get currency code
     *
     * @return string
     */
    public function getCurrencyCode(): string
    {
        if (empty($this->costs)) {
            throw new RuntimeException('Collection is empty');
        }

        return $this->costs[0]->getCurrencyCode();
    }

    /**
     * Validate shipper
     *
     * @param \Inspirum\Balikobot\Model\Values\PackageTransportCost $package
     *
     * @return void
     *
     * @throws \InvalidArgumentException
     */
    private function validateShipper(PackageTransportCost $package): void
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
    public function offsetExists($key)
    {
        return array_key_exists($key, $this->costs);
    }

    /**
     * Get an item at a given offset
     *
     * @param int $key
     *
     * @return \Inspirum\Balikobot\Model\Values\PackageTransportCost
     */
    public function offsetGet($key)
    {
        return $this->costs[$key];
    }

    /**
     * Set the item at a given offset
     *
     * @param int                                                   $key
     * @param \Inspirum\Balikobot\Model\Values\PackageTransportCost $value
     *
     * @return void
     */
    public function offsetSet($key, $value)
    {
        $this->validateShipper($value);

        $this->costs[$key] = $value;
    }

    /**
     * Unset the item at a given offset
     *
     * @param int $key
     *
     * @return void
     */
    public function offsetUnset($key)
    {
        unset($this->costs[$key]);
    }

    /**
     * Count elements of an object
     *
     * @return int
     */
    public function count(): int
    {
        return count($this->costs);
    }

    /**
     * Get an iterator for the items
     *
     * @return \ArrayIterator<int,\Inspirum\Balikobot\Model\Values\PackageTransportCost>
     */
    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->costs);
    }
}
