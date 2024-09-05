<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Package;

use Inspirum\Arrayable\Collection;
use Inspirum\Balikobot\Model\PerCarrierCollection;

/**
 * @extends \Inspirum\Arrayable\Collection<string,mixed,int,\Inspirum\Balikobot\Model\Package\Package>
 * @extends \Inspirum\Balikobot\Model\PerCarrierCollection<\Inspirum\Balikobot\Model\Package\Package>
 */
interface PackageCollection extends Collection, PerCarrierCollection
{
    /**
     * @return array<\Inspirum\Balikobot\Model\Package\Package>
     */
    public function getPackages(): array;

    /**
     * @return list<string>
     */
    public function getPackageIds(): array;

    public function getLabelsUrl(): ?string;
}
