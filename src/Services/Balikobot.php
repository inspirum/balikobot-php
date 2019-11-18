<?php

namespace Inspirum\Balikobot\Services;

use DateTime;
use Inspirum\Balikobot\Contracts\RequesterInterface;
use Inspirum\Balikobot\Definitions\Option;
use Inspirum\Balikobot\Definitions\Shipper;
use Inspirum\Balikobot\Model\Aggregates\OrderedPackageCollection;
use Inspirum\Balikobot\Model\Aggregates\PackageCollection;
use Inspirum\Balikobot\Model\Values\Branch;
use Inspirum\Balikobot\Model\Values\OrderedPackage;
use Inspirum\Balikobot\Model\Values\OrderedShipment;
use Inspirum\Balikobot\Model\Values\Package;
use Inspirum\Balikobot\Model\Values\PackageStatus;
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
     * @return string[]
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
        $version  = Shipper::resolveAddRequestVersion($packages->getShipper(), $packages->toArray());
        $response = $this->client->addPackages($packages->getShipper(), $packages->toArray(), $version);

        // create return value object
        $orderedPackages = new OrderedPackageCollection();

        foreach ($response as $i => $package) {
            $orderedPackages->add(OrderedPackage::newInstanceFromData(
                $packages->getShipper(),
                $packages->getEID(),
                $package
            ));
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
     * @param \DateTime|null                                                $date
     *
     * @return \Inspirum\Balikobot\Model\Values\OrderedShipment
     *
     * @throws \Inspirum\Balikobot\Contracts\ExceptionInterface
     */
    public function orderShipment(OrderedPackageCollection $packages, DateTime $date = null): OrderedShipment
    {
        if ($date !== null) {
            $date->setTime(0, 0, 0);
        }

        $response = $this->client->orderShipment($packages->getShipper(), $packages->getPackageIds(), $date);

        $orderedShipment = OrderedShipment::newInstanceFromData(
            $packages->getShipper(),
            $packages->getPackageIds(),
            $response,
            $date
        );

        return $orderedShipment;
    }

    /**
     * Track package
     *
     * @param \Inspirum\Balikobot\Model\Values\OrderedPackage $package
     *
     * @return \Inspirum\Balikobot\Model\Values\PackageStatus[]
     *
     * @throws \Inspirum\Balikobot\Contracts\ExceptionInterface
     */
    public function trackPackage(OrderedPackage $package): array
    {
        $packages = new OrderedPackageCollection();
        $packages->add($package);

        $response = $this->trackPackages($packages);

        return $response[0];
    }

    /**
     * Track packages
     *
     * @param \Inspirum\Balikobot\Model\Aggregates\OrderedPackageCollection $packages
     *
     * @return \Inspirum\Balikobot\Model\Values\PackageStatus[][]
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

        $response = $this->trackPackagesLastStatus($packages);

        return $response[0];
    }

    /**
     * Track package last status
     *
     * @param \Inspirum\Balikobot\Model\Aggregates\OrderedPackageCollection $packages
     *
     * @return \Inspirum\Balikobot\Model\Values\PackageStatus[]
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
     * @return \Inspirum\Balikobot\Model\Aggregates\OrderedPackageCollection
     *
     * @throws \Inspirum\Balikobot\Contracts\ExceptionInterface
     */
    public function getOverview(string $shipper): OrderedPackageCollection
    {
        $response = $this->client->getOverview($shipper);

        // create return value object
        $orderedPackages = new OrderedPackageCollection();

        foreach ($response as $i => $package) {
            $orderedPackages->add(OrderedPackage::newInstanceFromData(
                $shipper,
                $package['eshop_id'],
                $package
            ));
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
        $response = $this->client->getLabels($packages->getShipper(), $packages->getPackageIds());

        return $response;
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
        $response = $this->client->getPackageInfo($package->getShipper(), $package->getPackageId());

        $options              = $response;
        $options[Option::EID] = $package->getBatchId();

        unset($options['package_id']);
        unset($options['eshop_id']);
        unset($options['carrier_id']);
        unset($options['track_url']);
        unset($options['label_url']);
        unset($options['carrier_id_swap']);
        unset($options['pieces']);

        $package = new Package($options);

        return $package;
    }

    /**
     * Gets complete information about a package
     *
     * @param string $shipper
     * @param int    $orderId
     *
     * @return \Inspirum\Balikobot\Model\Values\OrderedShipment
     *
     * @throws \Inspirum\Balikobot\Contracts\ExceptionInterface
     */
    public function getOrder(string $shipper, int $orderId): OrderedShipment
    {
        $response = $this->client->getOrder($shipper, $orderId);

        $orderedShipment = OrderedShipment::newInstanceFromData(
            $shipper,
            $response['package_ids'],
            $response
        );

        return $orderedShipment;
    }

    /**
     * Returns available services for the given shipper
     *
     * @param string $shipper
     *
     * @return string[]
     *
     * @throws \Inspirum\Balikobot\Contracts\ExceptionInterface
     */
    public function getServices(string $shipper): array
    {
        $services = $this->client->getServices($shipper);

        return $services;
    }

    /**
     * Returns available manipulation units for the given shipper
     *
     * @param string $shipper
     *
     * @return string[]
     *
     * @throws \Inspirum\Balikobot\Contracts\ExceptionInterface
     */
    public function getManipulationUnits(string $shipper): array
    {
        $units = $this->client->getManipulationUnits($shipper);

        return $units;
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
        // get all shipper service codes
        $shippers = $this->getShippers();

        foreach ($shippers as $shipper) {
            yield from $this->getBranchesForShipper($shipper);
        }
    }

    /**
     * Get all available branches for countries
     *
     * @param array $countries
     *
     * @return \Generator|\Inspirum\Balikobot\Model\Values\Branch[]
     *
     * @throws \Inspirum\Balikobot\Contracts\ExceptionInterface
     */
    public function getBranchesForCountries(array $countries): iterable
    {
        // get all shipper service codes
        $shippers = $this->getShippers();

        foreach ($shippers as $shipper) {
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
        // get all services for shipper service
        $services = $this->getServicesForShipper($shipper);

        // get branches for all services
        foreach ($services as $service) {
            yield from $this->getBranchesForShipperService($shipper, $service);
        }
    }

    /**
     * Get all available branches for given shipper for countries
     *
     * @param string $shipper
     * @param array  $countries
     *
     * @return \Generator|\Inspirum\Balikobot\Model\Values\Branch[]
     *
     * @throws \Inspirum\Balikobot\Contracts\ExceptionInterface
     */
    public function getBranchesForShipperForCountries(string $shipper, array $countries): iterable
    {
        // get all services for shipper service
        $services = $this->getServicesForShipper($shipper);

        // get branches for all services
        foreach ($services as $service) {
            yield from $this->getBranchesForShipperServiceForCountries($shipper, $service, $countries);
        }
    }

    /**
     * Get services for shipper
     *
     * @param string $shipper
     *
     * @return array
     *
     * @throws \Inspirum\Balikobot\Contracts\ExceptionInterface
     */
    private function getServicesForShipper(string $shipper): array
    {
        // get all services for shipper service
        $services = array_keys($this->getServices($shipper));

        // support shipper withou service type
        if (empty($services)) {
            $services = [null];
        }

        return $services;
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
        $fullData = Shipper::hasFullBranchesSupport($shipper, $service);
        $branches = $this->client->getBranches($shipper, $service, $fullData, $country);

        foreach ($branches as $branch) {
            yield Branch::newInstanceFromData($shipper, $service, $branch);
        }
    }

    /**
     * Get all available branches for given shipper and service type for countries
     *
     * @param string      $shipper
     * @param string|null $service
     * @param array       $countries
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
        $branches = $this->getAllBranchesForShipperServiceForCountries($shipper, $service, $countries);

        foreach ($branches as $branch) {
            if (in_array($branch->getCountry(), $countries)) {
                yield $branch;
            }
        }
    }

    /**
     * Get all available branches for given shipper and service type filtered by countries if possible
     *
     * @param string      $shipper
     * @param string|null $service
     * @param array       $countries
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
            yield from $this->getBranchesForShipperService($shipper, $service);
            return;
        }

        foreach ($countries as $country) {
            yield from $this->getBranchesForShipperService($shipper, $service, $country);
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
     * @return array[]
     *
     * @throws \Inspirum\Balikobot\Contracts\ExceptionInterface
     */
    public function getCodCountries(string $shipper): array
    {
        $countries = $this->client->getCodCountries($shipper);

        return $countries;
    }

    /**
     * Returns list of countries where service is available in
     *
     * @param string $shipper
     *
     * @return array[]
     *
     * @throws \Inspirum\Balikobot\Contracts\ExceptionInterface
     */
    public function getCountries(string $shipper): array
    {
        $countries = $this->client->getCountries($shipper);

        return $countries;
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
        $postcodes = $this->client->getPostCodes($shipper, $service, $country);

        foreach ($postcodes as $postcode) {
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
     *
     * @return string[]
     *
     * @throws \Inspirum\Balikobot\Contracts\ExceptionInterface
     */
    public function getAdrUnits(string $shipper): array
    {
        $units = $this->client->getAdrUnits($shipper);

        return $units;
    }

    /**
     * Returns available activated services for the given shipper
     *
     * @param string $shipper
     *
     * @return array
     *
     * @throws \Inspirum\Balikobot\Contracts\ExceptionInterface
     */
    public function getActivatedServices(string $shipper): array
    {
        $units = $this->client->getActivatedServices($shipper);

        return $units;
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

        // create return value object
        $orderedPackages = new OrderedPackageCollection();

        foreach ($response as $i => $package) {
            $orderedPackages->add(OrderedPackage::newInstanceFromData(
                $packages->getShipper(),
                $packages->getEID(),
                $package
            ));
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

        $response = $this->getProofOfDeliveries($packages);

        return $response[0];
    }

    /**
     * Get array of PDF links with signed consignment delivery document by the recipient
     *
     * @param \Inspirum\Balikobot\Model\Aggregates\OrderedPackageCollection $packages
     *
     * @return string[]
     *
     * @throws \Inspirum\Balikobot\Contracts\ExceptionInterface
     */
    public function getProofOfDeliveries(OrderedPackageCollection $packages): array
    {
        $response = $this->client->getProofOfDeliveries($packages->getShipper(), $packages->getCarrierIds());

        return $response;
    }
}
