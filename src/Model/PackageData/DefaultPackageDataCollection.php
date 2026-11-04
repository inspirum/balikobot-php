<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\PackageData;

use Inspirum\Arrayable\BaseListCollection;
use function sprintf;
use function substr;
use function time;
use function uniqid;

/**
 * @extends \Inspirum\Arrayable\BaseListCollection<string,mixed,\Inspirum\Balikobot\Model\PackageData\PackageData>
 */
final class DefaultPackageDataCollection extends BaseListCollection implements PackageDataCollection
{
    /**
     * @param array<\Inspirum\Balikobot\Model\PackageData\PackageData> $items
     */
    public function __construct(
        private readonly string $carrier,
        array $items = [],
    ) {
        parent::__construct();

        foreach ($items as $package) {
            $this->add($package);
        }
    }

    public function getCarrier(): string
    {
        return $this->carrier;
    }

    /** @inheritDoc */
    public function getPackages(): array
    {
        return $this->getItems();
    }

    public function add(PackageData $item): void
    {
        $this->offsetAdd($item);
    }

    /**
     * @param non-negative-int|null $key
     * @param \Inspirum\Balikobot\Model\PackageData\PackageData $value
     */
    public function offsetSet(mixed $key, mixed $value): void
    {
        if ($key === null) {
            $this->offsetAdd($value);

            return;
        }

        parent::offsetSet($key, $this->clonePackageWithEid($value));
    }

    /**
     * @param \Inspirum\Balikobot\Model\PackageData\PackageData $value
     */
    public function offsetAdd(mixed $value): void
    {
        parent::offsetAdd($this->clonePackageWithEid($value));
    }

    private function clonePackageWithEid(PackageData $package): PackageData
    {
        $package = clone $package;

        if ($package->hasEID() === false) {
            $package->setEID($this->newEID());
        }

        return $package;
    }

    private function newEID(): string
    {
        return substr(sprintf('%s%s', time(), uniqid()), -20, 20);
    }
}
