<?php

namespace Inspirum\Balikobot\Services;

use DateTime;
use Inspirum\Balikobot\Contracts\RequesterInterface;
use Inspirum\Balikobot\Definitions\API;
use Inspirum\Balikobot\Definitions\Request;
use Inspirum\Balikobot\Definitions\Shipper;
use Inspirum\Balikobot\Exceptions\BadRequestException;

class Client
{
    /**
     * API requester
     *
     * @var \Inspirum\Balikobot\Contracts\RequesterInterface
     */
    private $requester;

    /**
     * Balikobot API client
     *
     * @param \Inspirum\Balikobot\Contracts\RequesterInterface $requester
     */
    public function __construct(RequesterInterface $requester)
    {
        $this->requester = $requester;
    }

    /**
     * Add package(s) to the Balikobot
     *
     * @param string                     $shipper
     * @param array<array<string,mixed>> $packages
     * @param string|null                $version
     * @param mixed|null                 $labelsUrl
     *
     * @return array<array<string,mixed>>
     *
     * @throws \Inspirum\Balikobot\Contracts\ExceptionInterface
     */
    public function addPackages(string $shipper, array $packages, string $version = null, &$labelsUrl = null): array
    {
        $response = $this->requester->call($version ?: API::V1, $shipper, Request::ADD, $packages);

        if (isset($response[0]['package_id']) === false) {
            throw new BadRequestException($response);
        }

        if (isset($response['labels_url'])) {
            $labelsUrl = $response['labels_url'];
        }

        unset($response['labels_url']);
        unset($response['status']);

        $this->validateIndexes($response, $packages);

        return $response;
    }

    /**
     * Drops a package from the Balikobot – the package must be not ordered
     *
     * @param string $shipper
     * @param int    $packageId
     *
     * @return void
     *
     * @throws \Inspirum\Balikobot\Contracts\ExceptionInterface
     */
    public function dropPackage(string $shipper, int $packageId): void
    {
        $this->dropPackages($shipper, [$packageId]);
    }

    /**
     * Drops a package from the Balikobot – the package must be not ordered
     *
     * @param string     $shipper
     * @param array<int> $packageIds
     *
     * @return void
     *
     * @throws \Inspirum\Balikobot\Contracts\ExceptionInterface
     */
    public function dropPackages(string $shipper, array $packageIds): void
    {
        $data = $this->encapsulateIds($packageIds);

        if (count($data) === 0) {
            return;
        }

        $this->requester->call(API::V1, $shipper, Request::DROP, $data);
    }

    /**
     * Tracks a package
     *
     * @param string $shipper
     * @param string $carrierId
     *
     * @return array<array<string,int|string>>
     *
     * @throws \Inspirum\Balikobot\Contracts\ExceptionInterface
     */
    public function trackPackage(string $shipper, string $carrierId): array
    {
        $response = $this->trackPackages($shipper, [$carrierId]);

        return $response[0];
    }

    /**
     * Tracks a packages
     *
     * @param string        $shipper
     * @param array<string> $carrierIds
     *
     * @return array<array<array<string,int|string>>>
     *
     * @throws \Inspirum\Balikobot\Contracts\ExceptionInterface
     */
    public function trackPackages(string $shipper, array $carrierIds): array
    {
        $data = $this->encapsulateIds($carrierIds);

        $response = $this->requester->call(API::V2, $shipper, Request::TRACK, $data, false);

        unset($response['status']);

        // fixes that API return only last package statuses for GLS shipper
        if ($shipper === Shipper::GLS && count($carrierIds) !== count($response)) {
            for ($i = 0; $i < count($carrierIds) - 1; $i++) {
                $response[$i] = $response[$i] ?? [];
            }
            sort($response);
        }

        $this->validateIndexes($response, $carrierIds);

        return $response;
    }

    /**
     * Tracks a package, get the last info
     *
     * @param string $shipper
     * @param string $carrierId
     *
     * @return array<string,int|string>
     *
     * @throws \Inspirum\Balikobot\Contracts\ExceptionInterface
     */
    public function trackPackageLastStatus(string $shipper, string $carrierId): array
    {
        $response = $this->trackPackagesLastStatus($shipper, [$carrierId]);

        return $response[0];
    }

    /**
     * Tracks a package, get the last info
     *
     * @param string        $shipper
     * @param array<string> $carrierIds
     *
     * @return array<array<string,int|string|null>>
     *
     * @throws \Inspirum\Balikobot\Contracts\ExceptionInterface
     */
    public function trackPackagesLastStatus(string $shipper, array $carrierIds): array
    {
        $data = $this->encapsulateIds($carrierIds);

        $response = $this->requester->call(API::V1, $shipper, Request::TRACK_STATUS, $data, false);

        unset($response['status']);

        $this->validateIndexes($response, $carrierIds);

        $formatedStatuses = [];

        foreach ($response as $responseItem) {
            $this->validateStatus($responseItem, $response);

            $formatedStatuses[] = [
                'name'      => $responseItem['status_text'],
                'status_id' => $responseItem['status_id'],
                'date'      => null,
            ];
        }

        return $formatedStatuses;
    }

    /**
     * Returns packages from the front (not ordered) for given shipper
     *
     * @param string $shipper
     *
     * @return array<array<string,int|string>>
     *
     * @throws \Inspirum\Balikobot\Contracts\ExceptionInterface
     */
    public function getOverview(string $shipper): array
    {
        $response = $this->requester->call(API::V1, $shipper, Request::OVERVIEW, [], false);

        return $response;
    }

    /**
     * Gets labels
     *
     * @param string     $shipper
     * @param array<int> $packageIds
     *
     * @return string
     *
     * @throws \Inspirum\Balikobot\Contracts\ExceptionInterface
     */
    public function getLabels(string $shipper, array $packageIds): string
    {
        $data = [
            'package_ids' => $packageIds,
        ];

        $response = $this->requester->call(API::V1, $shipper, Request::LABELS, $data);

        $formattedResponse = $response['labels_url'];

        return $formattedResponse;
    }

    /**
     * Gets complete information about a package
     *
     * @param string $shipper
     * @param int    $packageId
     *
     * @return array<string,int|string>
     *
     * @throws \Inspirum\Balikobot\Contracts\ExceptionInterface
     */
    public function getPackageInfo(string $shipper, int $packageId): array
    {
        $response = $this->requester->call(API::V1, $shipper, Request::PACKAGE . '/' . $packageId, [], false);

        return $response;
    }

    /**
     * Order shipment for packages
     *
     * @param string     $shipper
     * @param array<int> $packageIds
     *
     * @return array<string,int|string>
     *
     * @throws \Inspirum\Balikobot\Contracts\ExceptionInterface
     */
    public function orderShipment(string $shipper, array $packageIds): array
    {
        $data = [
            'package_ids' => $packageIds,
        ];

        $response = $this->requester->call(API::V1, $shipper, Request::ORDER, $data);

        unset($response['status']);

        return $response;
    }

    /**
     * Get order details
     *
     * @param string $shipper
     * @param int    $orderId
     *
     * @return array<string,int|string|array>
     *
     * @throws \Inspirum\Balikobot\Contracts\ExceptionInterface
     */
    public function getOrder(string $shipper, int $orderId): array
    {
        $response = $this->requester->call(API::V1, $shipper, Request::ORDER_VIEW . '/' . $orderId, [], false);

        unset($response['status']);

        return $response;
    }

    /**
     * Order pickup for packages
     *
     * @param string      $shipper
     * @param \DateTime   $dateFrom
     * @param \DateTime   $dateTo
     * @param float       $weight
     * @param int         $packageCount
     * @param string|null $message
     *
     * @return void
     *
     * @throws \Inspirum\Balikobot\Contracts\ExceptionInterface
     */
    public function orderPickup(
        string $shipper,
        DateTime $dateFrom,
        DateTime $dateTo,
        float $weight,
        int $packageCount,
        string $message = null
    ): void {
        $data = [
            'date'          => $dateFrom->format('Y-m-d'),
            'time_from'     => $dateFrom->format('H:s'),
            'time_to'       => $dateTo->format('H:s'),
            'weight'        => $weight,
            'package_count' => $packageCount,
            'message'       => $message,
        ];

        $this->requester->call(API::V1, $shipper, Request::ORDER_PICKUP, $data);
    }

    /**
     * Returns available services for the given shipper
     *
     * @param string      $shipper
     * @param string|null $country
     * @param string|null $version
     *
     * @return array<string,string>
     *
     * @throws \Inspirum\Balikobot\Contracts\ExceptionInterface
     */
    public function getServices(string $shipper, string $country = null, string $version = null): array
    {
        $response = $this->requester->call($version ?: API::V1, $shipper, Request::SERVICES . '/' . $country);

        $formattedResponse = $response['service_types'] ?? [];

        return $formattedResponse;
    }

    /**
     * Returns available B2A services for the given shipper
     *
     * @param string $shipper
     *
     * @return array<string,string>
     *
     * @throws \Inspirum\Balikobot\Contracts\ExceptionInterface
     */
    public function getB2AServices(string $shipper): array
    {
        $response = $this->requester->call(API::V1, $shipper, Request::B2A . '/' . Request::SERVICES);

        $formattedResponse = $response['service_types'] ?? [];

        return $formattedResponse;
    }

    /**
     * Returns all manipulation units for the given shipper
     *
     * @param string $shipper
     *
     * @return array<string,string>
     *
     * @throws \Inspirum\Balikobot\Contracts\ExceptionInterface
     */
    public function getManipulationUnits(string $shipper): array
    {
        $response = $this->requester->call(API::V1, $shipper, Request::MANIPULATION_UNITS);

        $formattedResponse = $this->normalizeResponseItems($response['units'] ?? [], 'code', 'name');

        return $formattedResponse;
    }

    /**
     * Returns available manipulation units for the given shipper
     *
     * @param string $shipper
     *
     * @return array<string,string>
     *
     * @throws \Inspirum\Balikobot\Contracts\ExceptionInterface
     */
    public function getActivatedManipulationUnits(string $shipper): array
    {
        $response = $this->requester->call(API::V1, $shipper, Request::ACTIVATED_MANIPULATION_UNITS);

        $formattedResponse = $this->normalizeResponseItems($response['units'] ?? [], 'code', 'name');

        return $formattedResponse;
    }

    /**
     * Returns available branches for the given shipper and its service
     * Full branches instead branches request
     *
     * @param string      $shipper
     * @param string|null $service
     * @param bool        $fullBranchRequest
     * @param string|null $country
     * @param string|null $version
     *
     * @return array<array<string,mixed>>
     *
     * @throws \Inspirum\Balikobot\Contracts\ExceptionInterface
     */
    public function getBranches(
        string $shipper,
        ?string $service,
        bool $fullBranchRequest = false,
        string $country = null,
        string $version = null
    ): array {
        $usedRequest = $fullBranchRequest ? Request::FULL_BRANCHES : Request::BRANCHES;

        $response = $this->requester->call(
            $version ?: API::V1,
            $shipper,
            $usedRequest . '/' . $service . '/' . $country
        );

        $formattedResponse = $response['branches'] ?? [];

        return $formattedResponse;
    }

    /**
     * Returns available branches for the given shipper in given location
     *
     * @param string      $shipper
     * @param string      $country
     * @param string      $city
     * @param string|null $postcode
     * @param string|null $street
     * @param int|null    $maxResults
     * @param float|null  $radius
     * @param string|null $type
     *
     * @return array<array<string,mixed>>
     *
     * @throws \Inspirum\Balikobot\Contracts\ExceptionInterface
     */
    public function getBranchesForLocation(
        string $shipper,
        string $country,
        string $city,
        string $postcode = null,
        string $street = null,
        int $maxResults = null,
        float $radius = null,
        string $type = null
    ): array {
        $data = [
            'country'     => $country,
            'city'        => $city,
            'zip'         => $postcode,
            'street'      => $street,
            'max_results' => $maxResults,
            'radius'      => $radius,
            'type'        => $type,
        ];

        $response = $this->requester->call(API::V1, $shipper, Request::BRANCH_LOCATOR, array_filter($data));

        $formattedResponse = $response['branches'] ?? [];

        return $formattedResponse;
    }

    /**
     * Returns list of countries where service with cash-on-delivery payment type is available in
     *
     * @param string $shipper
     *
     * @return array<array<int|string,array<string,array>>>
     *
     * @throws \Inspirum\Balikobot\Contracts\ExceptionInterface
     */
    public function getCodCountries(string $shipper): array
    {
        $response = $this->requester->call(API::V1, $shipper, Request::CASH_ON_DELIVERY_COUNTRIES);

        $formattedResponse = $this->normalizeResponseItems(
            $response['service_types'] ?? [],
            'service_type',
            'cod_countries'
        );

        return $formattedResponse;
    }

    /**
     * Returns list of countries where service is available in
     *
     * @param string $shipper
     *
     * @return array<array<int|string,string>>
     *
     * @throws \Inspirum\Balikobot\Contracts\ExceptionInterface
     */
    public function getCountries(string $shipper): array
    {
        $response = $this->requester->call(API::V1, $shipper, Request::COUNTRIES);

        $formattedResponse = $this->normalizeResponseItems(
            $response['service_types'] ?? [],
            'service_type',
            'countries'
        );

        return $formattedResponse;
    }

    /**
     * Returns available branches for the given shipper and its service
     *
     * @param string      $shipper
     * @param string      $service
     * @param string|null $country
     *
     * @return array<array<string,mixed>>
     *
     * @throws \Inspirum\Balikobot\Contracts\ExceptionInterface
     */
    public function getPostCodes(string $shipper, string $service, string $country = null): array
    {
        $response = $this->requester->call(API::V1, $shipper, Request::ZIP_CODES . '/' . $service . '/' . $country);

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
     * Check package(s) data
     *
     * @param string               $shipper
     * @param array<array<string>> $packages
     *
     * @return void
     *
     * @throws \Inspirum\Balikobot\Contracts\ExceptionInterface
     */
    public function checkPackages(string $shipper, array $packages): void
    {
        $this->requester->call(API::V1, $shipper, Request::CHECK, $packages);
    }

    /**
     * Returns available manipulation units for the given shipper
     *
     * @param string $shipper
     *
     * @return array<string>
     *
     * @throws \Inspirum\Balikobot\Contracts\ExceptionInterface
     */
    public function getAdrUnits(string $shipper): array
    {
        $response = $this->requester->call(API::V1, $shipper, Request::ADR_UNITS);

        $formattedResponse = $this->normalizeResponseItems($response['units'] ?? [], 'code', 'name');

        return $formattedResponse;
    }

    /**
     * Returns available activated services for the given shipper
     *
     * @param string $shipper
     *
     * @return array<string,mixed>
     *
     * @throws \Inspirum\Balikobot\Contracts\ExceptionInterface
     */
    public function getActivatedServices(string $shipper): array
    {
        $response = $this->requester->call(API::V1, $shipper, Request::ACTIVATED_SERVICES);

        unset($response['status']);

        return $response;
    }

    /**
     * Order shipments from place B (typically supplier / previous consignee) to place A (shipping point)
     *
     * @param string                     $shipper
     * @param array<array<string,mixed>> $packages
     *
     * @return array<array<string,mixed>>
     *
     * @throws \Inspirum\Balikobot\Contracts\ExceptionInterface
     */
    public function orderB2AShipment(string $shipper, array $packages): array
    {
        $response = $this->requester->call(API::V1, $shipper, Request::B2A, $packages);

        if (isset($response[0]['package_id']) === false) {
            throw new BadRequestException($response);
        }

        unset($response['status']);

        $this->validateIndexes($response, $packages);

        return $response;
    }

    /**
     * Get PDF link with signed consignment delivery document by the recipient
     *
     * @param string $shipper
     * @param string $carrierId
     *
     * @return string
     *
     * @throws \Inspirum\Balikobot\Contracts\ExceptionInterface
     */
    public function getProofOfDelivery(string $shipper, string $carrierId): string
    {
        $response = $this->getProofOfDeliveries($shipper, [$carrierId]);

        return $response[0];
    }

    /**
     * Get array of PDF links with signed consignment delivery document by the recipient
     *
     * @param string        $shipper
     * @param array<string> $carrierIds
     *
     * @return array<string>
     *
     * @throws \Inspirum\Balikobot\Contracts\ExceptionInterface
     */
    public function getProofOfDeliveries(string $shipper, array $carrierIds): array
    {
        $data = $this->encapsulateIds($carrierIds);

        $response = $this->requester->call(API::V1, $shipper, Request::PROOF_OF_DELIVERY, $data, false);

        unset($response['status']);

        $this->validateIndexes($response, $carrierIds);

        $formatedLinks = [];

        foreach ($response as $responseItem) {
            $this->validateStatus($responseItem, $response);

            $formatedLinks[] = $responseItem['file_url'];
        }

        return $formatedLinks;
    }

    /**
     * Obtain the price of carriage at consignment level
     *
     * @param string                     $shipper
     * @param array<array<string,mixed>> $packages
     *
     * @return array<array<string,mixed>>
     *
     * @throws \Inspirum\Balikobot\Contracts\ExceptionInterface
     */
    public function getTransportCosts(string $shipper, array $packages): array
    {
        $response = $this->requester->call(API::V1, $shipper, Request::TRANSPORT_COSTS, $packages);

        if (isset($response[0]['eid']) === false) {
            throw new BadRequestException($response);
        }

        unset($response['status']);

        $this->validateIndexes($response, $packages);

        return $response;
    }

    /**
     * Ģet information on individual countries of the world
     *
     * @return array<array<string,mixed>>
     *
     * @throws \Inspirum\Balikobot\Contracts\ExceptionInterface
     */
    public function getCountriesData(): array
    {
        $response = $this->requester->call(API::V1, '', Request::GET_COUNTRIES_DATA);

        $formattedResponse = $this->normalizeResponseItems($response['countries'] ?? [], 'iso_code', null);

        return $formattedResponse;
    }

    /**
     * Validate response item status
     *
     * @param array<mixed,mixed> $responseItem
     * @param array<mixed,mixed> $response
     *
     * @return void
     */
    private function validateStatus(array $responseItem, array $response): void
    {
        if (isset($responseItem['status']) && ((int) $responseItem['status']) !== 200) {
            throw new BadRequestException($response);
        }
    }

    /**
     * Validate indexes
     *
     * @param array<mixed,mixed> $response
     * @param array<mixed,mixed> $request
     *
     * @return void
     *
     * @throws \Inspirum\Balikobot\Exceptions\BadRequestException
     */
    private function validateIndexes(array $response, array $request): void
    {
        if (array_keys($response) !== range(0, count($request) - 1)) {
            throw new BadRequestException($response);
        }
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
    private function normalizeResponseItems(array $items, string $keyName, ?string $valueName): array
    {
        $formattedResponse = [];

        foreach ($items as $item) {
            $formattedResponse[$item[$keyName]] = $valueName !== null ? $item[$valueName] : $item;
        }

        return $formattedResponse;
    }

    /**
     * Encapsulate ids
     *
     * @param array<int|string> $ids
     *
     * @return array<array<int|string>>
     */
    private function encapsulateIds(array $ids): array
    {
        return array_map(function ($carrierId) {
            return [
                'id' => $carrierId,
            ];
        }, $ids);
    }
}
