<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\PostCode;

use Inspirum\Balikobot\Client\Request\CarrierType;
use Inspirum\Balikobot\Client\Request\ServiceType;

interface PostCodeFactory
{
    /**
     * @param array<string,string> $data
     */
    public function create(CarrierType $carrier, ?ServiceType $service, array $data): PostCode;
}
