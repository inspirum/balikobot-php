<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\PostCode;

use Inspirum\Balikobot\Client\Request\Carrier;
use Inspirum\Balikobot\Client\Request\Service;

final class DefaultPostCodeFactory implements PostCodeFactory
{
    /** @inheritDoc */
    public function create(Carrier $carrier, ?Service $service, array $data): PostCode
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

    /** @inheritDoc */
    public function createIterator(Carrier $carrier, ?Service $service, ?string $country, array $data): iterable
    {
        $country = $data['country'] ?? $country;

        foreach ($data['zip_codes'] ?? [] as $item) {
            $item['country'] ??= $country;

            yield $this->create($carrier, $service, $item);
        }
    }
}
