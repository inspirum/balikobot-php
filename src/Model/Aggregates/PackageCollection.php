<?php

namespace Inspirum\Balikobot\Model\Aggregates;

use ArrayIterator;
use Countable;
use Inspirum\Balikobot\Model\Values\Package;
use IteratorAggregate;

class PackageCollection implements IteratorAggregate, Countable
{
    /**
     * Packages
     *
     * @var \Inspirum\Balikobot\Model\Values\Package[]
     */
    private $packages = [];

    /**
     * Shipper code
     *
     * @var string
     */
    private $shipper;

    /**
     * EID
     *
     * @var string
     */
    private $eid;

    /**
     * PackageCollection constructor
     *
     * @param string      $shipper
     * @param string|null $eid
     */
    public function __construct(string $shipper, string $eid = null)
    {
        $this->shipper = $shipper;
        $this->eid     = $eid ?: $this->newEID();
    }

    /**
     * Add package to collection
     *
     * @param \Inspirum\Balikobot\Model\Values\Package $package
     *
     * @return void
     */
    public function add(Package $package): void
    {
        // clone package
        $package = clone $package;

        // set collection EID
        $package->setEID($this->eid);

        // add package to collection
        $this->packages[] = $package;
    }

    /**
     * Get packages shipper
     *
     * @return string
     */
    public function getShipper(): string
    {
        return $this->shipper;
    }

    /**
     * Get packages EID
     *
     * @return string
     */
    public function getEid(): string
    {
        return $this->eid;
    }

    /**
     * Get an iterator for the items
     *
     * @return \ArrayIterator
     */
    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->packages);
    }

    /**
     * Get the collection of packages as a plain array
     *
     * @return array[]
     */
    public function toArray(): array
    {
        return array_map(function (Package $package) {
            return $package->toArray();
        }, $this->packages);
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
     * Get new EID for package batch
     *
     * @return string
     */
    private function newEID(): string
    {
        return time() . uniqid();
    }
}
