<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\PackageData;

use Inspirum\Arrayable\ListCollection;

/**
 * @extends \Inspirum\Arrayable\ListCollection<string,mixed,\Inspirum\Balikobot\Model\PackageData\PackageData>
 */
interface PackageDataCollection extends ListCollection
{
    public function getCarrier(): string;

    /**
     * @return list<\Inspirum\Balikobot\Model\PackageData\PackageData>
     */
    public function getPackages(): array;
}
