<?php

namespace Inspirum\Balikobot\Services;

use DateTime;
use Inspirum\Balikobot\Contracts\RequesterInterface;
use Inspirum\Balikobot\Definitions\API;
use Inspirum\Balikobot\Definitions\Request;

class Client
{
    /**
     * API requester
     *
     * @var \Inspirum\Balikobot\Contracts\RequesterInterface
     */
    private $requester;

    /**
     * Request and Response formatter
     *
     * @var \Inspirum\Balikobot\Services\Formatter
     */
    private $formatter;

    /**
     * Response validator
     *
     * @var \Inspirum\Balikobot\Services\Validator
     */
    private $validator;

    /**
     * Balikobot API client
     *
     * @param \Inspirum\Balikobot\Contracts\RequesterInterface $requester
     */
    public function __construct(RequesterInterface $requester)
    {
        $this->requester = $requester;
        $this->validator = new Validator();
        $this->formatter = new Formatter($this->validator);
    }

    /**
     * Add package(s) to the Balikobot
     *
     * @param string                     $shipper
     * @param array<array<string,mixed>> $packages
     * @param mixed|null                 $labelsUrl
     *
     * @return array<array<string,mixed>>
     *
     * @throws \Inspirum\Balikobot\Contracts\ExceptionInterface
     */
    public function addPackages(string $shipper, array $packages, &$labelsUrl = null): array
    {
        $response = $this->requester->call(API::V2V1, $shipper, Request::ADD, ['packages' => $packages]);

        if (isset($response['labels_url'])) {
            $labelsUrl = $response['labels_url'];
        }

        $response = $response['packages'] ?? [];

        $this->validator->validateIndexes($response, count($packages));

        $this->validator->validateResponseItemHasAttribute($response, 'package_id', $response);

        return $response;
    }

    /**
     * Drops a package from the Balikobot – the package must be not ordered
     *
     * @param string $shipper
     * @param string $packageId
     *
     * @return void
     *
     * @throws \Inspirum\Balikobot\Contracts\ExceptionInterface
     */
    public function dropPackage(string $shipper, string $packageId): void
    {
        $this->dropPackages($shipper, [$packageId]);
    }

    /**
     * Drops a package from the Balikobot – the package must be not ordered
     *
     * @param string        $shipper
     * @param array<string> $packageIds
     *
     * @return void
     *
     * @throws \Inspirum\Balikobot\Contracts\ExceptionInterface
     */
    public function dropPackages(string $shipper, array $packageIds): void
    {
        if (count($packageIds) > 0) {
            $this->requester->call(API::V2V1, $shipper, Request::DROP, ['package_ids' => $packageIds]);
        }
    }

    /**
     * Tracks a package
     *
     * @param string $shipper
     * @param string $carrierId
     *
     * @return array<array<string,float|string>>
     *
     * @throws \Inspirum\Balikobot\Contracts\ExceptionInterface
     */
    public function trackPackage(string $shipper, string $carrierId): array
    {
        return $this->trackPackages($shipper, [$carrierId])[0];
    }

    /**
     * Tracks a packages
     *
     * @param string        $shipper
     * @param array<string> $carrierIds
     *
     * @return array<array<array<string,float|string>>>
     *
     * @throws \Inspirum\Balikobot\Contracts\ExceptionInterface
     */
    public function trackPackages(string $shipper, array $carrierIds): array
    {
        $response = $this->requester->call(API::V2V2, $shipper, Request::TRACK, ['carrier_ids' => $carrierIds], false);

        $response = $response['packages'] ?? [];

        $this->validator->validateIndexes($response, count($carrierIds));

        return $this->formatter->normalizeTrackPackagesResponse($response);
    }

    /**
     * Tracks a package, get the last info
     *
     * @param string $shipper
     * @param string $carrierId
     *
     * @return array<string,float|string|null>
     *
     * @throws \Inspirum\Balikobot\Contracts\ExceptionInterface
     */
    public function trackPackageLastStatus(string $shipper, string $carrierId): array
    {
        return $this->trackPackagesLastStatus($shipper, [$carrierId])[0];
    }

    /**
     * Tracks a package, get the last info
     *
     * @param string        $shipper
     * @param array<string> $carrierIds
     *
     * @return array<array<string,float|string|null>>
     *
     * @throws \Inspirum\Balikobot\Contracts\ExceptionInterface
     */
    public function trackPackagesLastStatus(string $shipper, array $carrierIds): array
    {
        $response = $this->requester->call(
            API::V2V1,
            $shipper,
            Request::TRACK_STATUS,
            ['carrier_ids' => $carrierIds],
            false
        );

        $response = $response['packages'] ?? [];

        $this->validator->validateIndexes($response, count($carrierIds));

        return $this->formatter->normalizeTrackPackagesLastStatusResponse($response);
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
        return $this->requester->call(API::V2V1, $shipper, Request::OVERVIEW, [], false);
    }

    /**
     * Gets labels
     *
     * @param string        $shipper
     * @param array<string> $packageIds
     *
     * @return string
     *
     * @throws \Inspirum\Balikobot\Contracts\ExceptionInterface
     */
    public function getLabels(string $shipper, array $packageIds): string
    {
        $response = $this->requester->call(API::V2V1, $shipper, Request::LABELS, ['package_ids' => $packageIds]);

        return $response['labels_url'];
    }

    /**
     * Gets complete information about a package by its package ID
     *
     * @param string $shipper
     * @param string $packageId
     *
     * @return array<string,int|string>
     *
     * @throws \Inspirum\Balikobot\Contracts\ExceptionInterface
     */
    public function getPackageInfo(string $shipper, string $packageId): array
    {
        return $this->requester->call(API::V2V1, $shipper, Request::PACKAGE . '/' . $packageId, [], false);
    }

    /**
     * Gets complete information about a package by its carrier ID
     *
     * @param string $shipper
     * @param string $carrierId
     *
     * @return array<string,int|string>
     *
     * @throws \Inspirum\Balikobot\Contracts\ExceptionInterface
     */
    public function getPackageInfoByCarrierId(string $shipper, string $carrierId): array
    {
        return $this->requester->call(
            API::V2V1,
            $shipper,
            Request::PACKAGE . '/carrier_id/' . $carrierId,
            [],
            false
        );
    }

    /**
     * Order shipment for packages
     *
     * @param string        $shipper
     * @param array<string> $packageIds
     *
     * @return array<string,int|string>
     *
     * @throws \Inspirum\Balikobot\Contracts\ExceptionInterface
     */
    public function orderShipment(string $shipper, array $packageIds): array
    {
        $response = $this->requester->call(API::V2V1, $shipper, Request::ORDER, ['package_ids' => $packageIds]);

        return $this->formatter->withoutStatus($response);
    }

    /**
     * Get order details
     *
     * @param string $shipper
     * @param string $orderId
     *
     * @return array<string,int|string|array>
     *
     * @throws \Inspirum\Balikobot\Contracts\ExceptionInterface
     */
    public function getOrder(string $shipper, string $orderId): array
    {
        $response = $this->requester->call(API::V2V1, $shipper, Request::ORDER_VIEW . '/' . $orderId, [], false);

        return $this->formatter->withoutStatus($response);
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
        $this->requester->call(API::V2V1, $shipper, Request::ORDER_PICKUP, [
            'date'          => $dateFrom->format('Y-m-d'),
            'time_from'     => $dateFrom->format('H:i'),
            'time_to'       => $dateTo->format('H:i),
            'weight'        => $weight,
            'package_count' => $packageCount,
            'message'       => $message,
        ]);
    }

    /**
     * Returns available services for the given shipper
     *
     * @param string $shipper
     *
     * @return array<string,string>
     *
     * @throws \Inspirum\Balikobot\Contracts\ExceptionInterface
     */
    public function getServices(string $shipper): array
    {
        $response = $this->requester->call(API::V2V1, $shipper, Request::SERVICES);

        return $this->formatter->normalizeResponseItems($response['service_types'] ?? [], 'service_type', 'name');
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
        $response = $this->requester->call(API::V2V1, $shipper, Request::B2A . '/' . Request::SERVICES);

        return $this->formatter->normalizeResponseItems($response['service_types'] ?? [], 'service_type', 'name');
    }

    /**
     * Returns all manipulation units for the given shipper
     *
     * @param string $shipper
     * @param bool   $fullData
     *
     * @return array<string,string|array>
     *
     * @throws \Inspirum\Balikobot\Contracts\ExceptionInterface
     */
    public function getManipulationUnits(string $shipper, bool $fullData = false): array
    {
        $response = $this->requester->call(API::V2V1, $shipper, Request::MANIPULATION_UNITS);

        return $this->formatter->normalizeResponseItems(
            $response['units'] ?? [],
            'code',
            $fullData === false ? 'name' : null
        );
    }

    /**
     * Returns available manipulation units for the given shipper
     *
     * @param string $shipper
     * @param bool   $fullData
     *
     * @return array<string,string|array>
     *
     * @throws \Inspirum\Balikobot\Contracts\ExceptionInterface
     */
    public function getActivatedManipulationUnits(string $shipper, bool $fullData = false): array
    {
        $response = $this->requester->call(API::V2V1, $shipper, Request::ACTIVATED_MANIPULATION_UNITS);

        return $this->formatter->normalizeResponseItems(
            $response['units'] ?? [],
            'code',
            $fullData === false ? 'name' : null
        );
    }

    /**
     * Returns available branches for the given shipper and its service
     * Full branches instead branches request
     *
     * @param string      $shipper
     * @param string|null $service
     * @param bool        $fullBranchesRequest
     * @param string|null $country
     *
     * @return array<array<string,mixed>>
     *
     * @throws \Inspirum\Balikobot\Contracts\ExceptionInterface
     */
    public function getBranches(
        string $shipper,
        ?string $service,
        bool $fullBranchesRequest = false,
        string $country = null
    ): array {
        $usedRequest = $fullBranchesRequest ? Request::FULL_BRANCHES : Request::BRANCHES;

        if ($service !== null) {
            $usedRequest .= '/service/' . $service;
        }

        if ($country !== null) {
            $usedRequest .= '/country/' . $country;
        }

        $response = $this->requester->call(API::V2V1, $shipper, $usedRequest);

        return $response['branches'] ?? [];
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
        $response = $this->requester->call(
            API::V2V1,
            $shipper,
            Request::BRANCH_LOCATOR,
            array_filter(
                [
                    'country'     => $country,
                    'city'        => $city,
                    'zip'         => $postcode,
                    'street'      => $street,
                    'max_results' => $maxResults,
                    'radius'      => $radius,
                    'type'        => $type,
                ]
            )
        );

        return $response['branches'] ?? [];
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
        $response = $this->requester->call(API::V2V1, $shipper, Request::CASH_ON_DELIVERY_COUNTRIES);

        return $this->formatter->normalizeResponseItems(
            $response['service_types'] ?? [],
            'service_type',
            'cod_countries'
        );
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
        $response = $this->requester->call(API::V2V1, $shipper, Request::COUNTRIES);

        return $this->formatter->normalizeResponseItems(
            $response['service_types'] ?? [],
            'service_type',
            'countries'
        );
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
        $response = $this->requester->call(API::V2V1, $shipper, Request::ZIP_CODES . '/' . $service . '/' . $country);

        return $this->formatter->normalizePostCodesResponse($response, $country);
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
        $this->requester->call(API::V2V1, $shipper, Request::CHECK, ['packages' => $packages]);
    }

    /**
     * Returns available manipulation units for the given shipper
     *
     * @param string $shipper
     * @param bool   $fullData
     *
     * @return array<string>
     *
     * @throws \Inspirum\Balikobot\Contracts\ExceptionInterface
     */
    public function getAdrUnits(string $shipper, bool $fullData = false): array
    {
        $response = $this->requester->call(API::V2V1, $shipper, Request::ADR_UNITS);

        return $this->formatter->normalizeResponseItems(
            $response['units'] ?? [],
            'code',
            $fullData === false ? 'name' : null
        );
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
        $response = $this->requester->call(API::V2V1, $shipper, Request::ACTIVATED_SERVICES);

        return $this->formatter->withoutStatus($response);
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

        $response = $this->formatter->withoutStatus($response);

        $this->validator->validateIndexes($response, count($packages));

        $this->validator->validateResponseItemHasAttribute($response, 'package_id', $response);

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
        return $this->getProofOfDeliveries($shipper, [$carrierId])[0];
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
        $response = $this->requester->call(
            API::V1,
            $shipper,
            Request::PROOF_OF_DELIVERY,
            $this->formatter->encapsulateIds($carrierIds, 'id'),
            false
        );

        $response = $this->formatter->withoutStatus($response);

        $this->validator->validateIndexes($response, count($carrierIds));

        return $this->formatter->normalizeProofOfDeliveriesResponse($response);
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

        unset($response['status']);

        $this->validator->validateIndexes($response, count($packages));

        $this->validator->validateResponseItemHasAttribute($response, 'eid', $response);

        return $response;
    }

    /**
     * Get information on individual countries of the world
     *
     * @return array<array<string,mixed>>
     *
     * @throws \Inspirum\Balikobot\Contracts\ExceptionInterface
     */
    public function getCountriesData(): array
    {
        $response = $this->requester->call(API::V2V1, '', Request::GET_COUNTRIES_DATA);

        return $this->formatter->normalizeResponseItems($response['countries'] ?? [], 'iso_code', null);
    }

    /**
     * Method for obtaining news in the Balikobot API
     *
     * @return array<string,mixed>
     *
     * @throws \Inspirum\Balikobot\Contracts\ExceptionInterface
     */
    public function getChangelog(): array
    {
        $response = $this->requester->call(API::V2V1, '', Request::CHANGELOG);

        return $this->formatter->withoutStatus($response);
    }

    /**
     * Method for easier carrier integration, obtaining list of available input attributes for the ADD method
     *
     * @param string $shipper
     *
     * @return array<string, array>
     *
     * @throws \Inspirum\Balikobot\Contracts\ExceptionInterface
     */
    public function getAddAttributes(string $shipper): array
    {
        $response = $this->requester->call(API::V1, $shipper, Request::ADD_ATTRIBUTES);

        return $this->formatter->normalizeResponseItems(
            $response['attributes'] ?? [],
            'name',
            null
        );
    }

    /**
     * Method for obtaining a list of additional services by individual transport services
     *
     * @param string      $shipper
     * @param string|null $service
     * @param bool        $fullData
     *
     * @return array<string, string|array|array<string, string|array>>
     *
     * @throws \Inspirum\Balikobot\Contracts\ExceptionInterface
     */
    public function getAddServiceOptions(string $shipper, string $service = null, bool $fullData = false): array
    {
        $response = $this->requester->call(API::V1, $shipper, Request::ADD_SERVICE_OPTIONS . '/' . $service);

        if ($service === null) {
            return $this->formatter->normalizeResponseIndexedItems(
                $response['service_types'] ?? [],
                'service_type',
                'services',
                'code',
                $fullData === false ? 'name' : null
            );
        }

        return $this->formatter->normalizeResponseItems(
            $response['services'] ?? [],
            'code',
            $fullData === false ? 'name' : null
        );
    }
}
