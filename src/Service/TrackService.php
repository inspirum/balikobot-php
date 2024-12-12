<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Service;

use Inspirum\Balikobot\Model\Package\Package;
use Inspirum\Balikobot\Model\Package\PackageCollection;
use Inspirum\Balikobot\Model\Status\Status;
use Inspirum\Balikobot\Model\Status\StatusCollection;
use Inspirum\Balikobot\Model\Status\Statuses;
use Inspirum\Balikobot\Model\Status\StatusesCollection;

interface TrackService
{
    /**
     * Track package
     *
     * @throws \Inspirum\Balikobot\Exception\Exception
     */
    public function trackPackage(Package $package): Statuses;

    /**
     * Tracks a package by carrier ID
     *
     * @throws \Inspirum\Balikobot\Exception\Exception
     */
    public function trackPackageById(string $carrier, string $carrierId): Statuses;

    /**
     * Track packages
     *
     * @throws \Inspirum\Balikobot\Exception\Exception
     */
    public function trackPackages(PackageCollection $packages): StatusesCollection;

    /**
     * Track packages by carrier IDs
     *
     * @param list<string> $carrierIds
     *
     * @throws \Inspirum\Balikobot\Exception\Exception
     */
    public function trackPackagesByIds(string $carrier, array $carrierIds): StatusesCollection;

    /**
     * Track package last status
     *
     * @throws \Inspirum\Balikobot\Exception\Exception
     */
    public function trackPackageLastStatus(Package $package): Status;

    /**
     * Track package last status by carrier ID
     *
     * @throws \Inspirum\Balikobot\Exception\Exception
     */
    public function trackPackageLastStatusById(string $carrier, string $carrierId): Status;

    /**
     * Track packages last statuses
     *
     * @throws \Inspirum\Balikobot\Exception\Exception
     */
    public function trackPackagesLastStatuses(PackageCollection $packages): StatusCollection;

    /**
     * Tracks a package, get the last info
     *
     * @param list<string> $carrierIds
     *
     * @throws \Inspirum\Balikobot\Exception\Exception
     */
    public function trackPackagesLastStatusesByIds(string $carrier, array $carrierIds): StatusCollection;
}
