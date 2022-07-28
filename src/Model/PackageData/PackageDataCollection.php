<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\PackageData;

use Inspirum\Arrayable\BaseCollection;
use function substr;
use function time;
use function uniqid;

/**
 * @extends \Inspirum\Arrayable\BaseCollection<string,mixed,int,\Inspirum\Balikobot\Model\PackageData\PackageData>
 */
class PackageDataCollection extends BaseCollection
{
    /**
     * @param array<\Inspirum\Balikobot\Model\PackageData\PackageData> $items
     */
    public function __construct(
        private string $carrier,
        array $items = [],
    ) {
        parent::__construct([]);

        foreach ($items as $package) {
            $this->add($package);
        }
    }

    public function getCarrier(): string
    {
        return $this->carrier;
    }

    public function add(PackageData $package): void
    {
        $package = clone $package;

        if ($package->hasEID() === false) {
            $package->setEID($this->newEID());
        }

        $this->offsetAdd($package);
    }

    private function newEID(): string
    {
        return substr(time() . uniqid(), -20, 20);
    }
}
