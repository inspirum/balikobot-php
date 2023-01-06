<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Service;

use DateTimeInterface;
use Inspirum\Balikobot\Model\OrderedShipment\OrderedShipment;
use Inspirum\Balikobot\Model\Package\Package;
use Inspirum\Balikobot\Model\Package\PackageCollection;
use Inspirum\Balikobot\Model\PackageData\PackageData;
use Inspirum\Balikobot\Model\PackageData\PackageDataCollection;
use Inspirum\Balikobot\Model\TransportCost\TransportCostCollection;

interface PackageService
{
    /**
     * Check if packages data are valid
     *
     * @throws \Inspirum\Balikobot\Exception\Exception
     */
    public function checkPackages(PackageDataCollection $packages): void;

    /**
     * Add packages
     *
     * @return \Inspirum\Balikobot\Model\Package\PackageCollection&array<\Inspirum\Balikobot\Model\Package\Package>
     *
     * @throws \Inspirum\Balikobot\Exception\Exception
     */
    public function addPackages(PackageDataCollection $packages): PackageCollection;

    /**
     * Drops packages
     *
     * @throws \Inspirum\Balikobot\Exception\Exception
     */
    public function dropPackages(PackageCollection $packages): void;

    /**
     * Drops package
     *
     * @throws \Inspirum\Balikobot\Exception\Exception
     */
    public function dropPackage(Package $package): void;

    /**
     * Drops package by its package ID
     *
     * @throws \Inspirum\Balikobot\Exception\Exception
     */
    public function dropPackageByPackageId(string $carrier, string $packageId): void;

    /**
     * Drops packages by theirs package IDs
     *
     * @param array<string> $packageIds
     *
     * @throws \Inspirum\Balikobot\Exception\Exception
     */
    public function dropPackagesByPackageIds(string $carrier, array $packageIds): void;

    /**
     * Order shipment for packages
     *
     * @throws \Inspirum\Balikobot\Exception\Exception
     */
    public function orderShipment(PackageCollection $packages): OrderedShipment;

    /**
     * Order shipment for packages by theirs IDs
     *
     * @param array<string> $packageIds
     *
     * @throws \Inspirum\Balikobot\Exception\Exception
     */
    public function orderShipmentByPackageIds(string $carrier, array $packageIds): OrderedShipment;

    /**
     * Get packages which was not yet sent
     *
     * @return \Inspirum\Balikobot\Model\Package\PackageCollection&array<\Inspirum\Balikobot\Model\Package\Package>
     *
     * @throws \Inspirum\Balikobot\Exception\Exception
     */
    public function getOverview(string $carrier): PackageCollection;

    /**
     * Get labels PDF link for packages
     *
     * @throws \Inspirum\Balikobot\Exception\Exception
     */
    public function getLabels(PackageCollection $packages): string;

    /**
     * Get labels PDF link for packages by theirs IDs
     *
     * @param array<string> $packageIds
     *
     * @throws \Inspirum\Balikobot\Exception\Exception
     */
    public function getLabelsByPackageIds(string $carrier, array $packageIds): string;

    /**
     * Get complete information about a package
     *
     * @throws \Inspirum\Balikobot\Exception\Exception
     */
    public function getPackageInfo(Package $package): PackageData;

    /**
     * Get complete information about a package by its package ID
     *
     * @throws \Inspirum\Balikobot\Exception\Exception
     */
    public function getPackageInfoByPackageId(string $carrier, string $packageId): PackageData;

    /**
     * Get complete information about a package by its carrier ID
     *
     * @throws \Inspirum\Balikobot\Exception\Exception
     */
    public function getPackageInfoByCarrierId(string $carrier, string $carrierId): PackageData;

    /**
     * Gets complete information about an ordered package
     *
     * @throws \Inspirum\Balikobot\Exception\Exception
     */
    public function getOrder(string $carrier, string $orderId): OrderedShipment;

    /**
     * Get PDF link with signed consignment delivery document by the recipient
     *
     * @throws \Inspirum\Balikobot\Exception\Exception
     */
    public function getProofOfDelivery(Package $package): string;

    /**
     * Get PDF links with signed consignment delivery document by the recipient
     *
     * @return array<string>
     *
     * @throws \Inspirum\Balikobot\Exception\Exception
     */
    public function getProofOfDeliveries(PackageCollection $packages): array;

    /**
     * Get PDF link with signed consignment delivery document by the recipient by carrier IDs
     *
     * @throws \Inspirum\Balikobot\Exception\Exception
     */
    public function getProofOfDeliveryByCarrierId(string $carrier, string $carrierId): string;

    /**
     * Get PDF links with signed consignment delivery document by the recipient by carrier ID
     *
     * @param array<string> $carrierIds
     *
     * @return array<string>
     *
     * @throws \Inspirum\Balikobot\Exception\Exception
     */
    public function getProofOfDeliveriesByCarrierIds(string $carrier, array $carrierIds): array;

    /**
     * Get the price of carriage at consignment level
     *
     * @return \Inspirum\Balikobot\Model\TransportCost\TransportCostCollection&array<\Inspirum\Balikobot\Model\TransportCost\TransportCost>
     *
     * @throws \Inspirum\Balikobot\Exception\Exception
     */
    public function getTransportCosts(PackageDataCollection $packages): TransportCostCollection;

    /**
     * Order a pickup for packages
     *
     * @throws \Inspirum\Balikobot\Exception\Exception
     */
    public function orderPickup(
        string $carrier,
        DateTimeInterface $dateFrom,
        DateTimeInterface $dateTo,
        float $weight,
        int $packageCount,
        ?string $message = null,
    ): void;

    /**
     * Order shipments from place B (typically supplier / previous consignee) to place A (shipping point)
     *
     * @return \Inspirum\Balikobot\Model\Package\PackageCollection&array<\Inspirum\Balikobot\Model\Package\Package>
     *
     * @throws \Inspirum\Balikobot\Exception\Exception
     */
    public function orderB2AShipment(PackageDataCollection $packages): PackageCollection;

    /**
     * Order shipments from place B (typically supplier / previous consignee) to place C (address other than shipping point)
     *
     * @return \Inspirum\Balikobot\Model\Package\PackageCollection&array<\Inspirum\Balikobot\Model\Package\Package>
     *
     * @throws \Inspirum\Balikobot\Exception\Exception
     */
    public function orderB2CShipment(PackageDataCollection $packages): PackageCollection;

    /**
     * Check if packages data are valid for B2A
     *
     * @throws \Inspirum\Balikobot\Exception\Exception
     */
    public function checkB2APackages(PackageDataCollection $packages): void;

    /**
     * Check if packages data are valid for B2C
     *
     * @throws \Inspirum\Balikobot\Exception\Exception
     */
    public function checkB2CPackages(PackageDataCollection $packages): void;
}
