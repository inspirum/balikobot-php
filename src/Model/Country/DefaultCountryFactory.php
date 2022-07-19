<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Country;

use function array_map;
use function is_array;

final class DefaultCountryFactory implements CountryFactory
{
    /** @inheritDoc */
    public function create(array $data): Country
    {
        return new Country(
            [
                'cs' => $data['name_cz'],
                'en' => $data['name_en'],
            ],
            $data['iso_code'],
            $data['currency'],
            is_array($data['phone_prefix']) ? $data['phone_prefix'] : [$data['phone_prefix']],
            $data['continent']
        );
    }

    /** @inheritDoc */
    public function createCollection(array $data): CountryCollection
    {
        return new CountryCollection(
            array_map(fn(array $country): Country => $this->create($country), $data['countries'] ?? [])
        );
    }

    /** @inheritDoc */
    public function createCodeCollection(array $data): array
    {
        return $data['countries'] ?? [];
    }

    /** @inheritDoc */
    public function createCodCountryCollection(array $data): array
    {
        $codCountries = [];
        foreach ($data['cod_countries'] ?? [] as $countryCode => $country) {
            $codCountries[] = new CodCountry(
                $countryCode,
                $country['currency'],
                $country['max_price'],
            );
        }

        return $codCountries;
    }
}
