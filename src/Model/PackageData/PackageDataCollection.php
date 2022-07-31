<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\PackageData;

use Inspirum\Arrayable\Collection;

/**
 * @extends \Inspirum\Arrayable\Collection<string,mixed,int,\Inspirum\Balikobot\Model\PackageData\PackageData>
 */
interface PackageDataCollection extends Collection
{
    public function getCarrier(): string;

    /**
     * @return array<\Inspirum\Balikobot\Model\PackageData\PackageData>
     */
    public function getPackages(): array;
}
