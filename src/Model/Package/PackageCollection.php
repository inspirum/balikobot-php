<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Package;

use Inspirum\Arrayable\ListCollection;
use Inspirum\Balikobot\Model\PerCarrierCollection;

/**
 * @extends \Inspirum\Arrayable\ListCollection<string,mixed,\Inspirum\Balikobot\Model\Package\Package>
 * @extends \Inspirum\Balikobot\Model\PerCarrierCollection<\Inspirum\Balikobot\Model\Package\Package>
 */
interface PackageCollection extends ListCollection, PerCarrierCollection
{
    /**
     * @return list<\Inspirum\Balikobot\Model\Package\Package>
     */
    public function getPackages(): array;

    /**
     * @return list<string>
     */
    public function getPackageIds(): array;

    public function getLabelsUrl(): ?string;
}
