<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Service;

use Inspirum\Balikobot\Model\Aggregates\OrderedPackageCollection;
use Inspirum\Balikobot\Model\PackageStatus;
use Inspirum\Balikobot\Model\Values\OrderedPackage;

interface TrackService
{
    /**
     * Track package
     *
     * @return array<\Inspirum\Balikobot\Model\PackageStatus>
     *
     * @throws \Inspirum\Balikobot\Exception\Exception
     */
    public function trackPackage(OrderedPackage $package): array;

    /**
     * Tracks a package by carrier ID
     *
     * @return array<\Inspirum\Balikobot\Model\PackageStatus>
     *
     * @throws \Inspirum\Balikobot\Exception\Exception
     */
    public function trackPackageById(string $carrier, string $carrierId): array;

    /**
     * Track packages
     *
     * @return array<array<int, \Inspirum\Balikobot\Model\PackageStatus>>
     *
     * @throws \Inspirum\Balikobot\Exception\Exception
     */
    public function trackPackages(OrderedPackageCollection $packages): array;

    /**
     * Tracks a packages by carrier IDs
     *
     * @param array<string> $carrierIds
     *
     * @return array<int, array<\Inspirum\Balikobot\Model\PackageStatus>>
     *
     * @throws \Inspirum\Balikobot\Exception\Exception
     */
    public function trackPackagesByIds(string $carrier, array $carrierIds): array;

    /**
     * Track package last status
     *
     * @throws \Inspirum\Balikobot\Exception\Exception
     */
    public function trackPackageLastStatus(OrderedPackage $package): PackageStatus;

    /**
     * Track package last status by carrier ID
     *
     * @throws \Inspirum\Balikobot\Exception\Exception
     */
    public function trackPackageLastStatusById(string $carrier, string $carrierId): PackageStatus;

    /**
     * Track packages last statuses
     *
     * @return array<\Inspirum\Balikobot\Model\PackageStatus>
     *
     * @throws \Inspirum\Balikobot\Exception\Exception
     */
    public function trackPackagesLastStatuses(OrderedPackageCollection $packages): array;

    /**
     * Tracks a package, get the last info
     *
     * @param array<string> $carrierIds
     *
     * @return array<\Inspirum\Balikobot\Model\PackageStatus>
     *
     * @throws \Inspirum\Balikobot\Exception\Exception
     */
    public function trackPackagesLastStatusesByIds(string $carrier, array $carrierIds): array;
}
