<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\ManipulationUnit;

use Inspirum\Arrayable\Collection;

/**
 * @extends \Inspirum\Arrayable\Collection<string,mixed,int,\Inspirum\Balikobot\Model\ManipulationUnit\ManipulationUnit>
 */
interface ManipulationUnitCollection extends Collection
{
    public function getCarrier(): string;

    /**
     * @return array<int,\Inspirum\Balikobot\Model\ManipulationUnit\ManipulationUnit>
     */
    public function getUnits(): array;
}
