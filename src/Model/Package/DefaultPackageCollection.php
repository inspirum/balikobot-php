<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Package;

use Inspirum\Balikobot\Model\BasePerCarrierCollection;
use function array_map;

/**
 * @extends \Inspirum\Balikobot\Model\BasePerCarrierCollection<string,mixed,int,\Inspirum\Balikobot\Model\Package\Package>
 */
final class DefaultPackageCollection extends BasePerCarrierCollection implements PackageCollection
{
    /**
     * @param array<\Inspirum\Balikobot\Model\Package\Package> $items
     */
    public function __construct(
        ?string $carrier = null,
        array $items = [],
        private ?string $labelsUrl = null,
    ) {
        parent::__construct($carrier, $items);
    }

    /** @inheritDoc */
    public function getPackages(): array
    {
        return $this->getItems();
    }

    /** @inheritDoc */
    public function getPackageIds(): array
    {
        return array_map(static fn(Package $package) => $package->getPackageId(), $this->items);
    }

    public function getLabelsUrl(): ?string
    {
        return $this->labelsUrl;
    }
}
