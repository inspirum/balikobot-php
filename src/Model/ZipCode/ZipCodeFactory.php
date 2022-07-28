<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\ZipCode;

use Iterator;

interface ZipCodeFactory
{
    /**
     * @param array<string,string> $data
     */
    public function create(string $carrier, ?string $service, array $data): ZipCode;

    /**
     * @param array<string,mixed> $data
     *
     * @return \Iterator<\Inspirum\Balikobot\Model\ZipCode\ZipCode>
     */
    public function createIterator(string $carrier, ?string $service, ?string $country, array $data): Iterator;
}
