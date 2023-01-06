<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Service;

use Inspirum\Balikobot\Client\Client;
use Inspirum\Balikobot\Definitions\Method;
use Inspirum\Balikobot\Definitions\Version;
use Inspirum\Balikobot\Model\Package\Package;
use Inspirum\Balikobot\Model\Package\PackageCollection;
use Inspirum\Balikobot\Model\Status\Status;
use Inspirum\Balikobot\Model\Status\StatusCollection;
use Inspirum\Balikobot\Model\Status\StatusFactory;
use Inspirum\Balikobot\Model\Status\Statuses;
use Inspirum\Balikobot\Model\Status\StatusesCollection;
use OutOfBoundsException;

final class DefaultTrackService implements TrackService
{
    public function __construct(
        private readonly Client $client,
        private readonly StatusFactory $statusFactory,
    ) {
    }

    public function trackPackage(Package $package): Statuses
    {
        return $this->trackPackageById($package->getCarrier(), $package->getCarrierId());
    }

    public function trackPackageById(string $carrier, string $carrierId): Statuses
    {
        return $this->trackPackagesByIds($carrier, [$carrierId])->getForCarrierId($carrierId) ?? throw new OutOfBoundsException();
    }

    public function trackPackages(PackageCollection $packages): StatusesCollection
    {
        return $this->trackPackagesByIds($packages->getCarrier(), $packages->getCarrierIds());
    }

    /** @inheritDoc */
    public function trackPackagesByIds(string $carrier, array $carrierIds): StatusesCollection
    {
        $response = $this->client->call(
            Version::V2V2,
            $carrier,
            Method::TRACK,
            ['carrier_ids' => $carrierIds],
            shouldHaveStatus: false,
        );

        return $this->statusFactory->createCollection($carrier, $carrierIds, $response);
    }

    public function trackPackageLastStatus(Package $package): Status
    {
        return $this->trackPackageLastStatusById($package->getCarrier(), $package->getCarrierId());
    }

    public function trackPackageLastStatusById(string $carrier, string $carrierId): Status
    {
        return $this->trackPackagesLastStatusesByIds($carrier, [$carrierId])->getForCarrierId($carrierId) ?? throw new OutOfBoundsException();
    }

    public function trackPackagesLastStatuses(PackageCollection $packages): StatusCollection
    {
        return $this->trackPackagesLastStatusesByIds($packages->getCarrier(), $packages->getCarrierIds());
    }

    /** @inheritDoc */
    public function trackPackagesLastStatusesByIds(string $carrier, array $carrierIds): StatusCollection
    {
        $response = $this->client->call(
            Version::V2V2,
            $carrier,
            Method::TRACK_STATUS,
            ['carrier_ids' => $carrierIds],
            shouldHaveStatus: false,
        );

        return $this->statusFactory->createLastStatusCollection($carrier, $carrierIds, $response);
    }
}
