<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Factories;

use Inspirum\Balikobot\Definitions\ServiceType;
use Inspirum\Balikobot\Definitions\Shipper;
use Inspirum\Balikobot\Model\Values\Branch;
use function sprintf;
use function trim;

class BranchFactory
{
    /**
     * Create branch from API response data
     *
     * @param string              $shipper
     * @param string|null         $service
     * @param array<string,mixed> $data
     *
     * @return \Inspirum\Balikobot\Model\Values\Branch
     */
    public static function createFromData(string $shipper, ?string $service, array $data): Branch
    {
        if ($shipper === Shipper::CP && $service === ServiceType::CP_NP) {
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

        return new Branch(
            $shipper,
            $service,
            $data['branch_id'] ?? (isset($data['id']) ? (string) $data['id'] : null),
            $data['branch_uid'] ?? null,
            $data['type'] ?? 'branch',
            $data['name'] ?? ($data['zip'] ?? '00000'),
            $data['city'] ?? '',
            $data['street'] ?? ($data['address'] ?? ''),
            $data['zip'] ?? '00000',
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
}
