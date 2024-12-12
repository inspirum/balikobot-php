<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Country;

interface CountryFactory
{
    /**
     * @param array<string,mixed> $data
     */
    public function create(array $data): Country;

    /**
     * @param array<string,mixed> $data
     */
    public function createCollection(array $data): CountryCollection;

    /**
     * @param array<string,mixed> $data
     *
     * @return list<string>
     */
    public function createCodeCollection(array $data): array;

    /**
     * @param array<string,mixed> $data
     *
     * @return array<\Inspirum\Balikobot\Model\Country\CodCountry>
     */
    public function createCodCountryCollection(array $data): array;
}
