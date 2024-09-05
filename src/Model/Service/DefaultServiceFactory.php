<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Service;

use Inspirum\Balikobot\Model\Country\CountryFactory;
use function array_key_exists;
use function array_map;
use function array_values;

final class DefaultServiceFactory implements ServiceFactory
{
    public function __construct(
        private readonly CountryFactory $countryFactory,
    ) {
    }

    /** @inheritDoc */
    public function create(string $carrier, array $data): Service
    {
        return new DefaultService(
            (string) $data['service_type'],
            $data['service_type_name'] ?? ($data['name'] ?? null),
            array_key_exists('services', $data) ? $this->createOptionCollection($data) : null,
            array_key_exists('countries', $data) ? $this->countryFactory->createCodeCollection($data) : null,
            array_key_exists('cod_countries', $data) ? $this->countryFactory->createCodCountryCollection($data) : null,
        );
    }

    /** @inheritDoc */
    public function createCollection(string $carrier, array $data): ServiceCollection
    {
        return new DefaultServiceCollection(
            $carrier,
            array_values(array_map(fn (array $service): Service => $this->create($carrier, $service), $data['service_types'] ?? [])),
            $data['active_parcel'] ?? null,
            $data['active_cargo'] ?? null,
        );
    }

    /**
     * @param array<string,mixed> $data
     */
    public function createOption(array $data): ServiceOption
    {
        return new DefaultServiceOption(
            $data['code'],
            $data['name'],
        );
    }

    /**
     * @param array<string,mixed> $data
     */
    private function createOptionCollection(array $data): ServiceOptionCollection
    {
        return new DefaultServiceOptionCollection(
            array_map(fn (array $data): ServiceOption => $this->createOption($data), $data['services'] ?? []),
        );
    }
}
