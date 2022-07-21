<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\ZipCode;

use Inspirum\Balikobot\Client\Request\Carrier;
use Inspirum\Balikobot\Client\Request\Service;
use Iterator;

interface ZipCodeFactory
{
    /**
     * @param array<string,string> $data
     */
    public function create(Carrier $carrier, ?Service $service, array $data): ZipCode;

    /**
     * @param array<string,mixed> $data
     *
     * @return \Iterator<\Inspirum\Balikobot\Model\ZipCode\ZipCode>
     */
    public function createIterator(Carrier $carrier, ?Service $service, ?string $country, array $data): Iterator;
}
