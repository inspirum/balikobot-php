<?php

namespace Inspirum\Balikobot\Services;

class Formatter
{
    /**
     * Response validator
     *
     * @var \Inspirum\Balikobot\Services\Validator
     */
    private $validator;

    /**
     * Formatter constructor.
     *
     * @param \Inspirum\Balikobot\Services\Validator $validator
     */
    public function __construct(Validator $validator)
    {
        $this->validator = $validator;
    }

    /**
     * Normalize "zipcodes" request response
     *
     * @param array<mixed,mixed> $response
     * @param string|null        $country
     *
     * @return array<array<string,mixed>>
     */
    public function normalizePostCodesResponse(array $response, string $country = null): array
    {
        $country = $response['country'] ?? $country;

        $formattedResponse = [];

        foreach ($response['zip_codes'] ?? [] as $responseItem) {
            $formattedResponse[] = [
                'postcode'     => $responseItem['zip'] ?? ($responseItem['zip_start'] ?? null),
                'postcode_end' => $responseItem['zip_end'] ?? null,
                'city'         => $responseItem['city'] ?? null,
                'country'      => $responseItem['country'] ?? $country,
                '1B'           => (bool) ($responseItem['1B'] ?? false),
            ];
        }

        return $formattedResponse;
    }

    /**
     * Normalize "trackstatus" request response
     *
     * @param array<mixed,mixed> $response
     *
     * @return array<array<string,float|string|null>>
     *
     * @throws \Inspirum\Balikobot\Contracts\ExceptionInterface
     */
    public function normalizeTrackPackagesLastStatusResponse(array $response): array
    {
        $formattedResponse = [];

        foreach ($response as $responseItem) {
            $this->validator->validateResponseStatus($responseItem, $response);

            $formattedResponse[] = [
                'name'          => $responseItem['status_text'],
                'name_internal' => $responseItem['status_text'],
                'type'          => 'event',
                'status_id'     => (float) $responseItem['status_id'],
                'date'          => null,
            ];
        }

        return $formattedResponse;
    }

    /**
     * Normalize "track" request response
     *
     * @param array<mixed,mixed> $response
     *
     * @return array<array<array<string,float|string>>>
     *
     * @throws \Inspirum\Balikobot\Contracts\ExceptionInterface
     */
    public function normalizeTrackPackagesResponse(array $response): array
    {
        $formattedResponse = [];

        foreach ($response ?? [] as $i => $responseItems) {
            $this->validator->validateResponseStatus($responseItems, $response);

            $formattedResponse[$i] = [];

            foreach ($responseItems['states'] ?? [] as $responseItem) {
                $formattedResponse[$i][] = [
                    'date'          => $responseItem['date'],
                    'name'          => $responseItem['name'],
                    'status_id'     => (float) ($responseItem['status_id_v2'] ?? $responseItem['status_id']),
                    'type'          => $responseItem['type'] ?? 'event',
                    'name_internal' => $responseItem['name_balikobot'] ?? $responseItem['name'],
                ];
            }
        }

        return $formattedResponse;
    }

    /**
     * Normalize "pod" request response
     *
     * @param array<mixed,mixed> $response
     *
     * @return array<string>
     *
     * @throws \Inspirum\Balikobot\Contracts\ExceptionInterface
     */
    public function normalizeProofOfDeliveriesResponse(array $response): array
    {
        $formattedResponse = [];

        foreach ($response as $responseItem) {
            $this->validator->validateResponseStatus($responseItem, $response);

            $formattedResponse[] = $responseItem['file_url'];
        }

        return $formattedResponse;
    }

    /**
     * Unset "status" attribute
     *
     * @param array<mixed,mixed> $response
     *
     * @return array<mixed,mixed>
     */
    public function withoutStatus(array $response): array
    {
        unset($response['status']);

        return $response;
    }

    /**
     * Normalize response items
     *
     * @param array<array<string,string>> $items
     * @param string                      $keyName
     * @param string|null                 $valueName
     *
     * @return array<string,mixed>
     */
    public static function normalizeResponseItems(array $items, string $keyName, ?string $valueName): array
    {
        $formattedItems = [];

        foreach ($items as $item) {
            $formattedItems[$item[$keyName]] = $valueName !== null ? $item[$valueName] : $item;
        }

        return $formattedItems;
    }

    /**
     * Encapsulate ids with key
     *
     * @param array<int|string> $ids
     * @param string            $keyName
     *
     * @return array<array<int|string>>
     */
    public function encapsulateIds(array $ids, string $keyName): array
    {
        $formattedItems = [];

        foreach ($ids as $id) {
            $formattedItems[] = [$keyName => $id];
        }

        return $formattedItems;
    }
}
