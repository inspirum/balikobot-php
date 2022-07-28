<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\ZipCode;

use Iterator;

final class DefaultZipCodeFactory implements ZipCodeFactory
{
    /** @inheritDoc */
    public function create(string $carrier, ?string $service, array $data): ZipCode
    {
        return new DefaultZipCode(
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
    public function createIterator(string $carrier, ?string $service, ?string $country, array $data): Iterator
    {
        $country = $data['country'] ?? $country;

        foreach ($data['zip_codes'] ?? [] as $item) {
            $item['country'] ??= $country;

            yield $this->create($carrier, $service, $item);
        }
    }
}
