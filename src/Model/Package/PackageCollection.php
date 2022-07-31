<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Package;

use Inspirum\Balikobot\Model\PerCarrierCollection;

/**
 * @extends \Inspirum\Balikobot\Model\PerCarrierCollection<\Inspirum\Balikobot\Model\Package\Package>
 */
interface PackageCollection extends PerCarrierCollection
{
    /**
     * @return array<\Inspirum\Balikobot\Model\Package\Package>
     */
    public function getPackages(): array;

    /**
     * @return array<string>
     */
    public function getPackageIds(): array;

    public function getLabelsUrl(): ?string;
}
