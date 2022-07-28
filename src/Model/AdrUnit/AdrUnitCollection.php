<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\AdrUnit;

use Inspirum\Arrayable\Collection;

/**
 * @extends \Inspirum\Arrayable\Collection<string,mixed,int,\Inspirum\Balikobot\Model\AdrUnit\AdrUnit>
 */
interface AdrUnitCollection extends Collection
{
    public function getCarrier(): string;

    /**
     * @return array<int,\Inspirum\Balikobot\Model\AdrUnit\AdrUnit>
     */
    public function getUnits(): array;
}
