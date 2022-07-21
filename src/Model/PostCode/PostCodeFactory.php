<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\PostCode;

use Inspirum\Balikobot\Client\Request\Carrier;
use Inspirum\Balikobot\Client\Request\Service;

interface PostCodeFactory
{
    /**
     * @param array<string,string> $data
     */
    public function create(Carrier $carrier, ?Service $service, array $data): PostCode;

    /**
     * @param array<string,mixed> $data
     *
     * @return iterable<\Inspirum\Balikobot\Model\PostCode\PostCode>
     */
    public function createIterator(Carrier $carrier, ?Service $service, ?string $country, array $data): iterable;
}
