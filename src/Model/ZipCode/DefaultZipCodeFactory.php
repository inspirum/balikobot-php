<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\ZipCode;

use Generator;

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
    public function createIterator(string $carrier, ?string $service, ?string $country, array $data): ZipCodeIterator
    {
        return new DefaultZipCodeIterator($carrier, $service, $this->generate($carrier, $service, $country, $data));
    }

    /**
     * @param array<string,mixed> $data
     *
     * @return \Generator<\Inspirum\Balikobot\Model\ZipCode\ZipCode>
     */
    private function generate(string $carrier, ?string $service, ?string $country, array $data): Generator
    {
        $country = $data['country'] ?? $country;

        foreach ($data['zip_codes'] ?? [] as $item) {
            $item['country'] ??= $country;

            yield $this->create($carrier, $service, $item);
        }
    }
}
