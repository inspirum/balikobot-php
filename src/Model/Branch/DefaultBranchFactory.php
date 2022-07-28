<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Branch;

use Inspirum\Balikobot\Definitions\Carrier;
use Inspirum\Balikobot\Definitions\ServiceType;
use Iterator;
use function sprintf;
use function str_replace;
use function trim;

final class DefaultBranchFactory implements BranchFactory
{
    /** @inheritDoc */
    public function create(string $carrier, ?string $service, array $data): Branch
    {
        if ($carrier === Carrier::CP && $service === ServiceType::CP_NP) {
            $data['country'] ??= 'CZ';
        }

        if (isset($data['street']) && (isset($data['house_number']) || isset($data['orientation_number']))) {
            $houseNumber       = (int) ($data['house_number'] ?? 0);
            $orientationNumber = (int) ($data['orientation_number'] ?? 0);
            $streetNumber      = trim(
                sprintf(
                    '%s/%s',
                    $houseNumber > 0 ? $houseNumber : '',
                    $orientationNumber > 0 ? $orientationNumber : ''
                ),
                '/'
            );

            $data['street'] = trim(sprintf('%s %s', $data['street'] ?: ($data['city'] ?? ''), $streetNumber));
        }

        $id   = $data['branch_id'] ?? (isset($data['id']) ? (string) $data['id'] : null);
        $zip  = $data['zip'] ?? '00000';
        $name = $data['name'] ?? $zip;

        return new DefaultBranch(
            $carrier,
            $service,
            $this->resolveBranchId($carrier, $service, [
                'id' => $id,
                'zip' => $zip,
                'name' => $name,
            ]),
            $id,
            $data['branch_uid'] ?? null,
            $data['type'] ?? 'branch',
            $name,
            $data['city'] ?? '',
            $data['street'] ?? ($data['address'] ?? ''),
            $zip,
            $data['country'] ?? null,
            $data['city_part'] ?? null,
            $data['district'] ?? null,
            $data['region'] ?? null,
            $data['currency'] ?? null,
            $data['photo_small'] ?? null,
            $data['photo_big'] ?? null,
            $data['url'] ?? null,
            (isset($data['latitude']) ? (float) trim((string) $data['latitude']) : null) ?: null,
            (isset($data['longitude']) ? (float) trim((string) $data['longitude']) : null) ?: null,
            $data['directions_global'] ?? null,
            $data['directions_car'] ?? null,
            $data['directions_public'] ?? null,
            isset($data['wheelchair_accessible']) ? (bool) $data['wheelchair_accessible'] : null,
            isset($data['claim_assistant']) ? (bool) $data['claim_assistant'] : null,
            isset($data['dressing_room']) ? (bool) $data['dressing_room'] : null,
            $data['opening_monday'] ?? null,
            $data['opening_tuesday'] ?? null,
            $data['opening_wednesday'] ?? null,
            $data['opening_thursday'] ?? null,
            $data['opening_friday'] ?? null,
            $data['opening_saturday'] ?? null,
            $data['opening_sunday'] ?? null,
            isset($data['max_weight']) ? (float) $data['max_weight'] : null
        );
    }

    /**
     * @inheritDoc
     */
    public function createIterator(string $carrier, ?string $service, array $data): Iterator
    {
        foreach ($data['branches'] ?? [] as $branch) {
            yield $this->create($carrier, $service, $branch);
        }
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
            || ($carrier === Carrier::ULOZENKA && $service === ServiceType::ULOZENKA_CP_NP)
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
}
