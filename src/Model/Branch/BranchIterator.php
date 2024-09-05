<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Branch;

use OuterIterator;

/**
 * @extends \OuterIterator<int,\Inspirum\Balikobot\Model\Branch\Branch>
 */
interface BranchIterator extends OuterIterator
{
    public function getCarrier(): ?string;

    public function getService(): ?string;

    /**
     * @return list<string>|null
     */
    public function getCountries(): ?array;
}
