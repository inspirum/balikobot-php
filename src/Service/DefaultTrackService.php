<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Service;

use Inspirum\Balikobot\Client\Client;
use Inspirum\Balikobot\Client\Request\Carrier;
use Inspirum\Balikobot\Definitions\Request;
use Inspirum\Balikobot\Definitions\VersionType;
use Inspirum\Balikobot\Model\Package\Package;
use Inspirum\Balikobot\Model\Package\PackageCollection;
use Inspirum\Balikobot\Model\Status\PackageStatusFactory;
use Inspirum\Balikobot\Model\Status\Status;
use Inspirum\Balikobot\Model\Status\StatusCollection;
use Inspirum\Balikobot\Model\Status\Statuses;
use Inspirum\Balikobot\Model\Status\StatusesCollection;
use OutOfBoundsException;

class DefaultTrackService implements TrackService
{
    public function __construct(
        private Client $client,
        private PackageStatusFactory $packageStatusFactory,
    ) {
    }

    public function trackPackage(Package $package): Statuses
    {
        return $this->trackPackageById($package->carrier, $package->carrierId);
    }

    public function trackPackageById(Carrier $carrier, string $carrierId): Statuses
    {
        return $this->trackPackagesByIds($carrier, [$carrierId])->getForCarrierId($carrierId) ?? throw new OutOfBoundsException();
    }

    public function trackPackages(PackageCollection $packages): StatusesCollection
    {
        return $this->trackPackagesByIds($packages->getCarrier(), $packages->getCarrierIds());
    }

    /** @inheritDoc */
    public function trackPackagesByIds(Carrier $carrier, array $carrierIds): StatusesCollection
    {
        $response = $this->client->call(
            VersionType::V2V2,
            $carrier,
            Request::TRACK,
            ['carrier_ids' => $carrierIds],
            shouldHaveStatus: false,
        );

        return $this->packageStatusFactory->createCollection($carrier, $carrierIds, $response);
    }

    public function trackPackageLastStatus(Package $package): Status
    {
        return $this->trackPackageLastStatusById($package->carrier, $package->carrierId);
    }

    public function trackPackageLastStatusById(Carrier $carrier, string $carrierId): Status
    {
        return $this->trackPackagesLastStatusesByIds($carrier, [$carrierId])->getForCarrierId($carrierId) ?? throw new OutOfBoundsException();
    }

    public function trackPackagesLastStatuses(PackageCollection $packages): StatusCollection
    {
        return $this->trackPackagesLastStatusesByIds($packages->getCarrier(), $packages->getCarrierIds());
    }

    /** @inheritDoc */
    public function trackPackagesLastStatusesByIds(Carrier $carrier, array $carrierIds): StatusCollection
    {
        $response = $this->client->call(
            VersionType::V2V2,
            $carrier,
            Request::TRACK_STATUS,
            ['carrier_ids' => $carrierIds],
            shouldHaveStatus: false,
        );

        return $this->packageStatusFactory->createLastStatusCollection($carrier, $carrierIds, $response);
    }
}
