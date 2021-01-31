<?php

namespace Inspirum\Balikobot\Services;

use Inspirum\Balikobot\Contracts\RequesterInterface;
use Inspirum\Balikobot\Definitions\Option;
use Inspirum\Balikobot\Definitions\Shipper;
use Inspirum\Balikobot\Model\Aggregates\OrderedPackageCollection;
use Inspirum\Balikobot\Model\Aggregates\PackageCollection;
use Inspirum\Balikobot\Model\Aggregates\PackageTransportCostCollection;
use Inspirum\Balikobot\Model\Values\Branch;
use Inspirum\Balikobot\Model\Values\Country;
use Inspirum\Balikobot\Model\Values\OrderedPackage;
use Inspirum\Balikobot\Model\Values\OrderedShipment;
use Inspirum\Balikobot\Model\Values\Package;
use Inspirum\Balikobot\Model\Values\PackageStatus;
use Inspirum\Balikobot\Model\Values\PackageTransportCost;
use Inspirum\Balikobot\Model\Values\PostCode;

class Balikobot
{
    /**
     * Balikobot API
     *
     * @var \Inspirum\Balikobot\Services\Client
     */
    private $client;

    /**
     * Balikobot constructor
     *
     * @param \Inspirum\Balikobot\Contracts\RequesterInterface $requester
     */
    public function __construct(RequesterInterface $requester)
    {
        $this->client = new Client($requester);
    }

    /**
     * All supported shipper services
     *
     * @return array<string>
     */
    public function getShippers(): array
    {
        return Shipper::all();
    }

    /**
     * Add packages
     *
     * @param \Inspirum\Balikobot\Model\Aggregates\PackageCollection $packages
     *
     * @return \Inspirum\Balikobot\Model\Aggregates\OrderedPackageCollection|\Inspirum\Balikobot\Model\Values\OrderedPackage[]
     *
     * @throws \Inspirum\Balikobot\Contracts\ExceptionInterface
     */
    public function addPackages(PackageCollection $packages): OrderedPackageCollection
    {
        $labelsUrl = null;
        $response  = $this->client->addPackages($packages->getShipper(), $packages->toArray(), $labelsUrl);

        $orderedPackages = new OrderedPackageCollection();
        $orderedPackages->setLabelsUrl($labelsUrl);

        foreach ($response as $i => $package) {
            $orderedPackages->add(OrderedPackage::newInstanceFromData($packages->getShipper(), $package));
        }

        return $orderedPackages;
    }

    /**
     * Exports order into Balikobot system
     *
     * @param \Inspirum\Balikobot\Model\Aggregates\OrderedPackageCollection $packages
     *
     * @return void
     *
     * @throws \Inspirum\Balikobot\Contracts\ExceptionInterface
     */
    public function dropPackages(OrderedPackageCollection $packages): void
    {
        $this->client->dropPackages($packages->getShipper(), $packages->getPackageIds());
    }

    /**
     * Exports order into Balikobot system
     *
     * @param \Inspirum\Balikobot\Model\Values\OrderedPackage $package
     *
     * @return void
     *
     * @throws \Inspirum\Balikobot\Contracts\ExceptionInterface
     */
    public function dropPackage(OrderedPackage $package): void
    {
        $this->client->dropPackage($package->getShipper(), $package->getPackageId());
    }

    /**
     * Order shipment
     *
     * @param \Inspirum\Balikobot\Model\Aggregates\OrderedPackageCollection $packages
     *
     * @return \Inspirum\Balikobot\Model\Values\OrderedShipment
     *
     * @throws \Inspirum\Balikobot\Contracts\ExceptionInterface
     */
    public function orderShipment(OrderedPackageCollection $packages): OrderedShipment
    {
        $response = $this->client->orderShipment($packages->getShipper(), $packages->getPackageIds());

        return OrderedShipment::newInstanceFromData(
            $packages->getShipper(),
            $packages->getPackageIds(),
            $response
        );
    }

    /**
     * Track package
     *
     * @param \Inspirum\Balikobot\Model\Values\OrderedPackage $package
     *
     * @return array<\Inspirum\Balikobot\Model\Values\PackageStatus>|\Inspirum\Balikobot\Model\Values\PackageStatus[]
     *
     * @throws \Inspirum\Balikobot\Contracts\ExceptionInterface
     */
    public function trackPackage(OrderedPackage $package): array
    {
        $packages = new OrderedPackageCollection();
        $packages->add($package);

        return $this->trackPackages($packages)[0];
    }

    /**
     * Track packages
     *
     * @param \Inspirum\Balikobot\Model\Aggregates\OrderedPackageCollection $packages
     *
     * @return array<array<\Inspirum\Balikobot\Model\Values\PackageStatus>>|\Inspirum\Balikobot\Model\Values\PackageStatus[][]
     *
     * @throws \Inspirum\Balikobot\Contracts\ExceptionInterface
     */
    public function trackPackages(OrderedPackageCollection $packages): array
    {
        $response = $this->client->trackPackages($packages->getShipper(), $packages->getCarrierIds());

        $statuses = [];

        foreach ($response as $i => $responseStatuses) {
            $statuses[$i] = [];

            foreach ($responseStatuses as $status) {
                $statuses[$i][] = PackageStatus::newInstanceFromData($status);
            }
        }

        return $statuses;
    }

    /**
     * Track package last status
     *
     * @param \Inspirum\Balikobot\Model\Values\OrderedPackage $package
     *
     * @return \Inspirum\Balikobot\Model\Values\PackageStatus
     *
     * @throws \Inspirum\Balikobot\Contracts\ExceptionInterface
     */
    public function trackPackageLastStatus(OrderedPackage $package): PackageStatus
    {
        $packages = new OrderedPackageCollection();
        $packages->add($package);

        return $this->trackPackagesLastStatus($packages)[0];
    }

    /**
     * Track package last status
     *
     * @param \Inspirum\Balikobot\Model\Aggregates\OrderedPackageCollection $packages
     *
     * @return array<\Inspirum\Balikobot\Model\Values\PackageStatus>|\Inspirum\Balikobot\Model\Values\PackageStatus[]
     *
     * @throws \Inspirum\Balikobot\Contracts\ExceptionInterface
     */
    public function trackPackagesLastStatus(OrderedPackageCollection $packages): array
    {
        $response = $this->client->trackPackagesLastStatus($packages->getShipper(), $packages->getCarrierIds());

        $statuses = [];

        foreach ($response as $status) {
            $statuses[] = PackageStatus::newInstanceFromData($status);
        }

        return $statuses;
    }

    /**
     * Get overview for given shipper
     *
     * @param string $shipper
     *
     * @return \Inspirum\Balikobot\Model\Aggregates\OrderedPackageCollection|\Inspirum\Balikobot\Model\Values\OrderedPackage[]
     *
     * @throws \Inspirum\Balikobot\Contracts\ExceptionInterface
     */
    public function getOverview(string $shipper): OrderedPackageCollection
    {
        $response = $this->client->getOverview($shipper);

        $response = $response['packages'];

        $orderedPackages = new OrderedPackageCollection();

        foreach ($response as $package) {
            $orderedPackage = OrderedPackage::newInstanceFromData($shipper, $package);
            $orderedPackages->add($orderedPackage);
        }

        return $orderedPackages;
    }

    /**
     * Get labels for orders
     *
     * @param \Inspirum\Balikobot\Model\Aggregates\OrderedPackageCollection $packages
     *
     * @return string
     *
     * @throws \Inspirum\Balikobot\Contracts\ExceptionInterface
     */
    public function getLabels(OrderedPackageCollection $packages): string
    {
        return $this->client->getLabels($packages->getShipper(), $packages->getPackageIds());
    }

    /**
     * Gets complete information about a package
     *
     * @param \Inspirum\Balikobot\Model\Values\OrderedPackage $package
     *
     * @return \Inspirum\Balikobot\Model\Values\Package
     *
     * @throws \Inspirum\Balikobot\Contracts\ExceptionInterface
     */
    public function getPackageInfo(OrderedPackage $package): Package
    {
        $response = $this->client->getPackageInfoByCarrierId($package->getShipper(), $package->getCarrierId());

        unset(
            $response['package_id'],
            $response['eshop_id'],
            $response['carrier_id'],
            $response['track_url'],
            $response['label_url'],
            $response['carrier_id_swap'],
            $response['pieces']
        );

        $options              = $response;
        $options[Option::EID] = $package->getBatchId();

        return new Package($options);
    }

    /**
     * Gets complete information about a package
     *
     * @param string $shipper
     * @param string $orderId
     *
     * @return \Inspirum\Balikobot\Model\Values\OrderedShipment
     *
     * @throws \Inspirum\Balikobot\Contracts\ExceptionInterface
     */
    public function getOrder(string $shipper, string $orderId): OrderedShipment
    {
        $response = $this->client->getOrder($shipper, $orderId);

        return OrderedShipment::newInstanceFromData($shipper, $response['package_ids'], $response);
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
        return $this->client->getServices($shipper);
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
        return $this->client->getB2AServices($shipper);
    }

    /**
     * Returns all manipulation units for the given shipper
     *
     * @param string $shipper
     * @param bool   $fullData
     *
     * @return array<string|array>
     *
     * @throws \Inspirum\Balikobot\Contracts\ExceptionInterface
     */
    public function getManipulationUnits(string $shipper, bool $fullData = false): array
    {
        return $this->client->getManipulationUnits($shipper, $fullData);
    }

    /**
     * Returns available manipulation units for the given shipper
     *
     * @param string $shipper
     * @param bool   $fullData
     *
     * @return array<string|array>
     *
     * @throws \Inspirum\Balikobot\Contracts\ExceptionInterface
     */
    public function getActivatedManipulationUnits(string $shipper, bool $fullData = false): array
    {
        return $this->client->getActivatedManipulationUnits($shipper, $fullData);
    }

    /**
     * Get all available branches
     *
     * @return \Generator|\Inspirum\Balikobot\Model\Values\Branch[]
     *
     * @throws \Inspirum\Balikobot\Contracts\ExceptionInterface
     */
    public function getBranches(): iterable
    {
        foreach ($this->getShippers() as $shipper) {
            yield from $this->getBranchesForShipper($shipper);
        }
    }

    /**
     * Get all available branches for countries
     *
     * @param array<string> $countries
     *
     * @return \Generator|\Inspirum\Balikobot\Model\Values\Branch[]
     *
     * @throws \Inspirum\Balikobot\Contracts\ExceptionInterface
     */
    public function getBranchesForCountries(array $countries): iterable
    {
        foreach ($this->getShippers() as $shipper) {
            yield from $this->getBranchesForShipperForCountries($shipper, $countries);
        }
    }

    /**
     * Get all available branches for given shipper
     *
     * @param string $shipper
     *
     * @return \Generator|\Inspirum\Balikobot\Model\Values\Branch[]
     *
     * @throws \Inspirum\Balikobot\Contracts\ExceptionInterface
     */
    public function getBranchesForShipper(string $shipper): iterable
    {
        foreach ($this->getServicesForShipper($shipper) as $service) {
            yield from $this->getBranchesForShipperService($shipper, $service);
        }
    }

    /**
     * Get all available branches for given shipper for countries
     *
     * @param string        $shipper
     * @param array<string> $countries
     *
     * @return \Generator|\Inspirum\Balikobot\Model\Values\Branch[]
     *
     * @throws \Inspirum\Balikobot\Contracts\ExceptionInterface
     */
    public function getBranchesForShipperForCountries(string $shipper, array $countries): iterable
    {
        foreach ($this->getServicesForShipper($shipper) as $service) {
            yield from $this->getBranchesForShipperServiceForCountries($shipper, $service, $countries);
        }
    }

    /**
     * Get services for shipper
     *
     * @param string $shipper
     *
     * @return array<string|null>
     *
     * @throws \Inspirum\Balikobot\Contracts\ExceptionInterface
     */
    private function getServicesForShipper(string $shipper): array
    {
        return array_keys($this->getServices($shipper)) ?: [null];
    }

    /**
     * Get all available branches for given shipper and service type for countries
     *
     * @param string        $shipper
     * @param string|null   $service
     * @param array<string> $countries
     *
     * @return \Generator|\Inspirum\Balikobot\Model\Values\Branch[]
     *
     * @throws \Inspirum\Balikobot\Contracts\ExceptionInterface
     */
    public function getBranchesForShipperServiceForCountries(
        string $shipper,
        ?string $service,
        array $countries
    ): iterable {
        foreach ($this->getAllBranchesForShipperServiceForCountries($shipper, $service, $countries) as $branch) {
            if (in_array($branch->getCountry(), $countries)) {
                yield $branch;
            }
        }
    }

    /**
     * Get all available branches for given shipper and service type filtered by countries if possible
     *
     * @param string        $shipper
     * @param string|null   $service
     * @param array<string> $countries
     *
     * @return \Generator|\Inspirum\Balikobot\Model\Values\Branch[]
     *
     * @throws \Inspirum\Balikobot\Contracts\ExceptionInterface
     */
    private function getAllBranchesForShipperServiceForCountries(
        string $shipper,
        ?string $service,
        array $countries
    ): iterable {
        if (Shipper::hasBranchCountryFilterSupport($shipper) === false) {
            return yield from $this->getBranchesForShipperService($shipper, $service);
        }

        foreach ($countries as $country) {
            yield from $this->getBranchesForShipperService($shipper, $service, $country);
        }
    }

    /**
     * Get all available branches for given shipper and service type
     *
     * @param string      $shipper
     * @param string|null $service
     * @param string|null $country
     *
     * @return \Generator|\Inspirum\Balikobot\Model\Values\Branch[]
     *
     * @throws \Inspirum\Balikobot\Contracts\ExceptionInterface
     */
    public function getBranchesForShipperService(string $shipper, ?string $service, string $country = null): iterable
    {
        $useFullBranchRequest = Shipper::hasFullBranchesSupport($shipper, $service);

        foreach ($this->client->getBranches($shipper, $service, $useFullBranchRequest, $country) as $branch) {
            yield Branch::newInstanceFromData($shipper, $service, $branch);
        }
    }

    /**
     * Get all available branches for given shipper
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
     * @return \Generator|\Inspirum\Balikobot\Model\Values\Branch[]
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
    ): iterable {
        $branches = $this->client->getBranchesForLocation(
            $shipper,
            $country,
            $city,
            $postcode,
            $street,
            $maxResults,
            $radius,
            $type
        );

        foreach ($branches as $branch) {
            yield Branch::newInstanceFromData($shipper, null, $branch);
        }
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
        return $this->client->getCodCountries($shipper);
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
        return $this->client->getCountries($shipper);
    }

    /**
     * Returns available branches for the given shipper and its service
     *
     * @param string      $shipper
     * @param string      $service
     * @param string|null $country
     *
     * @return \Generator|\Inspirum\Balikobot\Model\Values\PostCode[]
     *
     * @throws \Inspirum\Balikobot\Contracts\ExceptionInterface
     */
    public function getPostCodes(string $shipper, string $service, string $country = null): iterable
    {
        foreach ($this->client->getPostCodes($shipper, $service, $country) as $postcode) {
            yield PostCode::newInstanceFromData($shipper, $service, $postcode);
        }
    }

    /**
     * Check package(s) data
     *
     * @param \Inspirum\Balikobot\Model\Aggregates\PackageCollection $packages
     *
     * @return void
     *
     * @throws \Inspirum\Balikobot\Contracts\ExceptionInterface
     */
    public function checkPackages(PackageCollection $packages): void
    {
        $this->client->checkPackages($packages->getShipper(), $packages->toArray());
    }

    /**
     * Returns available manipulation units for the given shipper
     *
     * @param string $shipper
     * @param bool   $fullData
     *
     * @return array<string|array>
     *
     * @throws \Inspirum\Balikobot\Contracts\ExceptionInterface
     */
    public function getAdrUnits(string $shipper, bool $fullData = false): array
    {
        return $this->client->getAdrUnits($shipper, $fullData);
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
        return $this->client->getActivatedServices($shipper);
    }

    /**
     * Order shipments from place B (typically supplier / previous consignee) to place A (shipping point)
     *
     * @param \Inspirum\Balikobot\Model\Aggregates\PackageCollection $packages
     *
     * @return \Inspirum\Balikobot\Model\Aggregates\OrderedPackageCollection|\Inspirum\Balikobot\Model\Values\OrderedPackage[]
     *
     * @throws \Inspirum\Balikobot\Contracts\ExceptionInterface
     */
    public function orderB2AShipment(PackageCollection $packages): OrderedPackageCollection
    {
        $response = $this->client->orderB2AShipment($packages->getShipper(), $packages->toArray());

        $orderedPackages = new OrderedPackageCollection();

        foreach ($response as $i => $package) {
            $package['eid'] = (string) $packages->offsetGet($i)->getEID();
            $orderedPackage = OrderedPackage::newInstanceFromData($packages->getShipper(), $package);
            $orderedPackages->add($orderedPackage);
        }

        return $orderedPackages;
    }

    /**
     * Get PDF link with signed consignment delivery document by the recipient
     *
     * @param \Inspirum\Balikobot\Model\Values\OrderedPackage $package
     *
     * @return string
     *
     * @throws \Inspirum\Balikobot\Contracts\ExceptionInterface
     */
    public function getProofOfDelivery(OrderedPackage $package): string
    {
        $packages = new OrderedPackageCollection();
        $packages->add($package);

        return $this->getProofOfDeliveries($packages)[0];
    }

    /**
     * Get array of PDF links with signed consignment delivery document by the recipient
     *
     * @param \Inspirum\Balikobot\Model\Aggregates\OrderedPackageCollection $packages
     *
     * @return array<string>
     *
     * @throws \Inspirum\Balikobot\Contracts\ExceptionInterface
     */
    public function getProofOfDeliveries(OrderedPackageCollection $packages): array
    {
        return $this->client->getProofOfDeliveries($packages->getShipper(), $packages->getCarrierIds());
    }

    /**
     * Obtain the price of carriage at consignment level
     *
     * @param \Inspirum\Balikobot\Model\Aggregates\PackageCollection $packages
     *
     * @return \Inspirum\Balikobot\Model\Aggregates\PackageTransportCostCollection|\Inspirum\Balikobot\Model\Values\PackageTransportCost[]
     *
     * @throws \Inspirum\Balikobot\Contracts\ExceptionInterface
     */
    public function getTransportCosts(PackageCollection $packages): PackageTransportCostCollection
    {
        $response = $this->client->getTransportCosts($packages->getShipper(), $packages->toArray());

        $transportCosts = new PackageTransportCostCollection($packages->getShipper());

        foreach ($response as $i => $package) {
            $transportCost = PackageTransportCost::newInstanceFromData($packages->getShipper(), $package);
            $transportCosts->add($transportCost);
        }

        return $transportCosts;
    }

    /**
     * Get information on individual countries of the world
     *
     * @return array<string,\Inspirum\Balikobot\Model\Values\Country>|\Inspirum\Balikobot\Model\Values\Country[]
     *
     * @throws \Inspirum\Balikobot\Contracts\ExceptionInterface
     */
    public function getCountriesData(): array
    {
        $response = $this->client->getCountriesData();

        $countries = [];

        foreach ($response as $code => $country) {
            $countries[$code] = Country::newInstanceFromData($country);
        }

        return $countries;
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
        return $this->client->getChangelog();
    }
}
