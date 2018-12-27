<?php

namespace Inspirum\Balikobot\Model\Aggregates;

use ArrayAccess;
use ArrayIterator;
use Countable;
use Inspirum\Balikobot\Model\Values\OrderedPackage;
use InvalidArgumentException;
use IteratorAggregate;
use RuntimeException;

class OrderedPackageCollection implements IteratorAggregate, Countable, ArrayAccess
{
    /**
     * Packages.
     *
     * @var \Inspirum\Balikobot\Model\Values\OrderedPackage[]
     */
    private $packages = [];
    
    /**
     * Shipper code.
     *
     * @var string|null
     */
    private $shipper;
    
    /**
     * OrderedPackageCollection constructor.
     *
     * @param string|null $shipper
     */
    public function __construct(string $shipper = null)
    {
        $this->shipper = $shipper;
    }
    
    /**
     * Add package.
     *
     * @param \Inspirum\Balikobot\Model\Values\OrderedPackage $package
     *
     * @throws \InvalidArgumentException
     */
    public function add(OrderedPackage $package): void
    {
        //validate package shipper
        $this->validateShipper($package);
        
        // add package to collection
        $this->packages[] = $package;
    }
    
    /**
     * Get shipper.
     *
     * @return string
     */
    public function getShipper(): string
    {
        if ($this->shipper === null) {
            throw new RuntimeException('No shipper is set.');
        }
        
        return $this->shipper;
    }
    
    /**
     * Get package IDs.
     *
     * @return int[]
     */
    public function getPackageIds(): array
    {
        return array_map(function (OrderedPackage $package) {
            return $package->getPackageId();
        }, $this->packages);
    }
    
    /**
     * Get carrier IDs.
     *
     * @return int[]
     */
    public function getCarrierIds(): array
    {
        return array_map(function (OrderedPackage $package) {
            return $package->getCarrierId();
        }, $this->packages);
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
     * Get an iterator for the items.
     *
     * @return \ArrayIterator
     */
    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->packages);
    }
    
    /**
     * Determine if an item exists at an offset.
     *
     * @param string $key
     *
     * @return bool
     */
    public function offsetExists($key)
    {
        return array_key_exists($key, $this->packages);
    }
    
    /**
     * Get an item at a given offset.
     *
     * @param string $key
     *
     * @return \Inspirum\Balikobot\Model\Values\OrderedPackage
     */
    public function offsetGet($key)
    {
        return $this->packages[$key];
    }
    
    /**
     * Set the item at a given offset.
     *
     * @param string                                          $key
     * @param \Inspirum\Balikobot\Model\Values\OrderedPackage $value
     *
     * @return void
     */
    public function offsetSet($key, $value)
    {
        $this->validateShipper($value);
        
        $this->packages[$key] = $value;
    }
    
    /**
     * Unset the item at a given offset.
     *
     * @param string $key
     *
     * @return void
     */
    public function offsetUnset($key)
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
}
