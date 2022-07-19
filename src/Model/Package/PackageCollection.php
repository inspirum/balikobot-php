<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Package;

use Inspirum\Balikobot\Client\Request\CarrierType;
use Inspirum\Balikobot\Model\BasePerCarrierCollection;
use function array_map;

/**
 * @extends \Inspirum\Balikobot\Model\BasePerCarrierCollection<string,mixed,int,\Inspirum\Balikobot\Model\Package\Package>
 */
class PackageCollection extends BasePerCarrierCollection
{
    /**
     * @param array<\Inspirum\Balikobot\Model\Package\Package> $packages
     */
    public function __construct(
        ?CarrierType $carrier = null,
        array $packages = [],
        private ?string $labelsUrl = null,
    ) {
        parent::__construct($carrier, $packages);
    }

    /**
     * @return array<string>
     */
    public function getPackageIds(): array
    {
        return array_map(static fn(Package $package) => $package->packageId, $this->items);
    }

    public function getLabelsUrl(): ?string
    {
        return $this->labelsUrl;
    }
}
