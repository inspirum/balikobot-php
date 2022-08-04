<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\ZipCode;

use Iterator;

/**
 * @extends \Iterator<int,\Inspirum\Balikobot\Model\ZipCode\ZipCode>
 */
interface ZipCodeIterator extends Iterator
{
    public function getCarrier(): string;

    public function getService(): ?string;
}
