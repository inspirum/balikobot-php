<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\ManipulationUnit;

use Inspirum\Arrayable\ListCollection;

/**
 * @extends \Inspirum\Arrayable\ListCollection<string,mixed,\Inspirum\Balikobot\Model\ManipulationUnit\ManipulationUnit>
 */
interface ManipulationUnitCollection extends ListCollection
{
    public function getCarrier(): string;

    /**
     * @return list<\Inspirum\Balikobot\Model\ManipulationUnit\ManipulationUnit>
     */
    public function getUnits(): array;
}
