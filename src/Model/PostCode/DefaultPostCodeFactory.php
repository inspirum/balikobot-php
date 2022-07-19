<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\PostCode;

use Inspirum\Balikobot\Client\Request\CarrierType;
use Inspirum\Balikobot\Client\Request\ServiceType;

final class DefaultPostCodeFactory implements PostCodeFactory
{
    /** @inheritDoc */
    public function create(CarrierType $carrier, ?ServiceType $service, array $data): PostCode
    {
        return new PostCode(
            $carrier,
            $service,
            $data['postcode'],
            $data['postcode_end'] ?? null,
            $data['city'] ?? null,
            $data['country'] ?? null,
            (bool) ($data['1B'] ?? false),
        );
    }
}
