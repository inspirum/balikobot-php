<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\ManipulationUnit;

interface ManipulationUnitFactory
{
    /**
     * @param array<string,mixed> $data
     */
    public function create(array $data): ManipulationUnit;

    /**
     * @param array<string,mixed> $data
     */
    public function createCollection(string $carrier, array $data): ManipulationUnitCollection;
}
