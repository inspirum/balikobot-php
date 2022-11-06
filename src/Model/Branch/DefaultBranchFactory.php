<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Branch;

use Generator;
use Inspirum\Balikobot\Definitions\Carrier;
use Inspirum\Balikobot\Definitions\Service;
use Traversable;
use function sprintf;
use function str_replace;
use function trim;

final class DefaultBranchFactory implements BranchFactory
{
    /** @inheritDoc */
    public function create(string $carrier, ?string $service, array $data): Branch
    {
        $data = $this->normalizeData($carrier, $service, $data);

        return new DefaultBranch(
            $carrier,
            $service,
            $data['branch_id'],
            $data['id'],
            $data['branch_uid'] ?? null,
            $data['type'],
            $data['name'],
            $data['city'],
            $data['street'],
            $data['zip'],
            $data['country'] ?? null,
            $data['city_part'] ?? null,
            $data['district'] ?? null,
            $data['region'] ?? null,
            $data['currency'] ?? null,
            $data['photo_small'] ?? null,
            $data['photo_big'] ?? null,
            $data['url'] ?? null,
            $data['latitude'] ?? null,
            $data['longitude'] ?? null,
            $data['directions_global'] ?? null,
            $data['directions_car'] ?? null,
            $data['directions_public'] ?? null,
            $data['wheelchair_accessible'] ?? null,
            $data['claim_assistant'] ?? null,
            $data['dressing_room'] ?? null,
            $data['opening_monday'] ?? null,
            $data['opening_tuesday'] ?? null,
            $data['opening_wednesday'] ?? null,
            $data['opening_thursday'] ?? null,
            $data['opening_friday'] ?? null,
            $data['opening_saturday'] ?? null,
            $data['opening_sunday'] ?? null,
            $data['max_weight'] ?? null,
        );
    }

    /** @inheritDoc */
    public function createIterator(string $carrier, ?string $service, ?array $countries, array $data): BranchIterator
    {
        return new DefaultBranchIterator($carrier, $service, $countries, $this->generate($carrier, $service, $data));
    }

    /** @inheritDoc */
    public function wrapIterator(?string $carrier, ?string $service, ?array $countries, Traversable $iterator): BranchIterator
    {
        return new DefaultBranchIterator($carrier, $service, $countries, $iterator);
    }

    /**
     * @param array<string,mixed> $data
     *
     * @return \Generator<int,\Inspirum\Balikobot\Model\Branch\Branch>
     */
    private function generate(string $carrier, ?string $service, array $data): Generator
    {
        foreach ($data['branches'] ?? [] as $branch) {
            yield $this->create($carrier, $service, $branch);
        }
    }

    /**
     * @param array<string,mixed> $data
     *
     * @return  array<string,mixed>
     */
    private function normalizeData(string $carrier, ?string $service, array $data): array
    {
        $data['country']               = $this->resolveCountry($carrier, $service, $data);
        $data['type']                ??= 'branch';
        $data['city']                ??= '';
        $data['zip']                 ??= '00000';
        $data['street']                = $this->resolveStreet($data);
        $data['id']                    = $data['branch_id'] ?? (isset($data['id']) ? (string) $data['id'] : null);
        $data['name']                ??= $data['zip'];
        $data['latitude']              = $this->castFloat($data, 'latitude');
        $data['longitude']             = $this->castFloat($data, 'longitude');
        $data['wheelchair_accessible'] = $this->castBool($data, 'wheelchair_accessible');
        $data['claim_assistant']       = $this->castBool($data, 'claim_assistant');
        $data['dressing_room']         = $this->castBool($data, 'dressing_room');
        $data['max_weight']            = $this->castFloat($data, 'max_weight');
        $data['branch_id']             = $this->resolveBranchId($carrier, $service, $data);

        return $data;
    }

    /**
     * @param array<string,mixed> $data
     */
    private function castBool(array $data, string $key): ?bool
    {
        return isset($data[$key]) ? (bool) $data[$key] : null;
    }

    /**
     * @param array<string,mixed> $data
     */
    private function castFloat(array $data, string $key): ?float
    {
        return isset($data[$key]) ? (float) trim((string) $data[$key]) : null;
    }

    /**
     * @param array<string,mixed> $data
     */
    private function resolveBranchId(string $carrier, ?string $service, array $data): string
    {
        // get key used in branch_id when calling add request
        if (
            $carrier === Carrier::CP
            || $carrier === Carrier::SP
            || ($carrier === Carrier::ULOZENKA && $service === Service::ULOZENKA_CP_NP)
        ) {
            return str_replace(' ', '', $data['zip']);
        }

        if ($carrier === Carrier::PPL) {
            return str_replace('KM', '', (string) $data['id']);
        }

        if ($carrier === Carrier::INTIME) {
            return $data['name'];
        }

        return (string) $data['id'];
    }

    /**
     * @param array<string,mixed> $data
     */
    private function resolveCountry(string $carrier, ?string $service, array $data): ?string
    {
        if ($carrier === Carrier::CP && $service === Service::CP_NP) {
            $data['country'] ??= 'CZ';
        }

        return $data['country'] ?? null;
    }

    /**
     * @param array<string,mixed> $data
     */
    private function resolveStreet(array $data): string
    {
        if (isset($data['street']) && (isset($data['house_number']) || isset($data['orientation_number']))) {
            $houseNumber       = (int) ($data['house_number'] ?? 0);
            $orientationNumber = (int) ($data['orientation_number'] ?? 0);
            $streetNumber      = trim(
                sprintf(
                    '%s/%s',
                    $houseNumber > 0 ? $houseNumber : '',
                    $orientationNumber > 0 ? $orientationNumber : '',
                ),
                '/',
            );

            $data['street'] = trim(sprintf('%s %s', $data['street'] ?: ($data['city'] ?? ''), $streetNumber));
        }

        $data['street'] ??= $data['address'] ?? '';

        return $data['street'];
    }
}
