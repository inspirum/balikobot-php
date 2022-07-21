<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\ZipCode;

use Inspirum\Balikobot\Client\Request\Carrier;
use Inspirum\Balikobot\Client\Request\Service;
use Iterator;

final class DefaultZipCodeFactory implements ZipCodeFactory
{
    /** @inheritDoc */
    public function create(Carrier $carrier, ?Service $service, array $data): ZipCode
    {
        return new ZipCode(
            $carrier,
            $service,
            $data['zip'] ?? ($data['zip_start'] ?? null),
            $data['zip_end'] ?? null,
            $data['city'] ?? null,
            $data['country'] ?? null,
            (bool) ($data['1B'] ?? false),
        );
    }

    /** @inheritDoc */
    public function createIterator(Carrier $carrier, ?Service $service, ?string $country, array $data): Iterator
    {
        $country = $data['country'] ?? $country;

        foreach ($data['zip_codes'] ?? [] as $item) {
            $item['country'] ??= $country;

            yield $this->create($carrier, $service, $item);
        }
    }
}
