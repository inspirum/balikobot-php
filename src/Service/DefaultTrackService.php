<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Service;

use Inspirum\Balikobot\Client\Client;
use Inspirum\Balikobot\Definitions\Request;
use Inspirum\Balikobot\Definitions\Version;
use Inspirum\Balikobot\Model\Aggregates\OrderedPackageCollection;
use Inspirum\Balikobot\Model\PackageStatus;
use Inspirum\Balikobot\Model\PackageStatusFactory;
use Inspirum\Balikobot\Model\Values\OrderedPackage;
use Inspirum\Balikobot\Response\Validator;
use function count;

class DefaultTrackService implements TrackService
{
    public function __construct(
        private Client $client,
        private Validator $validator,
        private PackageStatusFactory $packageStatusFactory,
    ) {
    }

    /**
     * @inheritDoc
     */
    public function trackPackage(OrderedPackage $package): array
    {
        return $this->trackPackageById($package->carrier, $package->carrierId);
    }

    /**
     * @inheritDoc
     */
    public function trackPackageById(string $carrier, string $carrierId): array
    {
        return $this->trackPackagesByIds($carrier, [$carrierId])[0];
    }

    /**
     * @inheritDoc
     */
    public function trackPackages(OrderedPackageCollection $packages): array
    {
        return $this->trackPackagesByIds($packages->getCarrier(), $packages->getCarrierIds());
    }

    /**
     * @inheritDoc
     */
    public function trackPackagesByIds(string $carrier, array $carrierIds): array
    {
        $response = $this->client->call(
            Version::V2V2,
            $carrier,
            Request::TRACK,
            ['carrier_ids' => $carrierIds],
            shouldHaveStatus: false,
        );

        $packages = $response['packages'] ?? [];
        $this->validator->validateIndexes($packages, count($carrierIds));

        $statuses = [];
        foreach ($packages as $packageIndex => $package) {
            $this->validator->validateResponseStatus($package, $response);

            $statuses[(int) $packageIndex] = [];
            foreach ($package['states'] ?? [] as $status) {
                $statuses[(int) $packageIndex][] = $this->packageStatusFactory->createFromStatusData($status, $response);
            }
        }

        return $statuses;
    }

    public function trackPackageLastStatus(OrderedPackage $package): PackageStatus
    {
        return $this->trackPackageLastStatusById($package->carrier, $package->carrierId);
    }

    public function trackPackageLastStatusById(string $carrier, string $carrierId): PackageStatus
    {
        return $this->trackPackagesLastStatusesByIds($carrier, [$carrierId])[0];
    }

    /**
     * @inheritDoc
     */
    public function trackPackagesLastStatuses(OrderedPackageCollection $packages): array
    {
        return $this->trackPackagesLastStatusesByIds($packages->getCarrier(), $packages->getCarrierIds());
    }

    /**
     * @inheritDoc
     */
    public function trackPackagesLastStatusesByIds(string $carrier, array $carrierIds): array
    {
        $response = $this->client->call(
            Version::V2V2,
            $carrier,
            Request::TRACK_STATUS,
            ['carrier_ids' => $carrierIds],
            shouldHaveStatus: false,
        );

        $packages = $response['packages'] ?? [];
        $this->validator->validateIndexes($packages, count($carrierIds));

        $statuses = [];
        foreach ($packages as $packageIndex => $status) {
            $this->validator->validateResponseStatus($status, $response);

            $statuses[(int) $packageIndex] = $this->packageStatusFactory->createFromLastStatusData($status, $response);
        }

        return $statuses;
    }
}
