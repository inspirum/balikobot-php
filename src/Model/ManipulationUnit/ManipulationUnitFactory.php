<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\ManipulationUnit;

use Inspirum\Balikobot\Client\Request\Carrier;

interface ManipulationUnitFactory
{
    /**
     * @param array<string,mixed> $data
     */
    public function create(array $data): ManipulationUnit;

    /**
     * @param array<string,mixed> $data
     */
    public function createCollection(Carrier $carrierType, array $data): ManipulationUnitCollection;
}
