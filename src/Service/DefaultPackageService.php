<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Service;

use DateTimeInterface;
use Inspirum\Balikobot\Client\Client;
use Inspirum\Balikobot\Definitions\Method;
use Inspirum\Balikobot\Definitions\Version;
use Inspirum\Balikobot\Exception\BadRequestException;
use Inspirum\Balikobot\Model\Label\LabelFactory;
use Inspirum\Balikobot\Model\OrderedShipment\OrderedShipment;
use Inspirum\Balikobot\Model\OrderedShipment\OrderedShipmentFactory;
use Inspirum\Balikobot\Model\Package\Package;
use Inspirum\Balikobot\Model\Package\PackageCollection;
use Inspirum\Balikobot\Model\Package\PackageFactory;
use Inspirum\Balikobot\Model\PackageData\PackageData;
use Inspirum\Balikobot\Model\PackageData\PackageDataCollection;
use Inspirum\Balikobot\Model\PackageData\PackageDataFactory;
use Inspirum\Balikobot\Model\ProofOfDelivery\ProofOfDeliveryFactory;
use Inspirum\Balikobot\Model\TransportCost\TransportCostCollection;
use Inspirum\Balikobot\Model\TransportCost\TransportCostFactory;
use function array_key_exists;
use function array_map;
use function count;
use function sprintf;

final class DefaultPackageService implements PackageService
{
    public function __construct(
        private Client $client,
        private PackageDataFactory $packageDataFactory,
        private PackageFactory $packageFactory,
        private OrderedShipmentFactory $orderedShipmentFactory,
        private LabelFactory $labelFactory,
        private ProofOfDeliveryFactory $proofOfDeliveryFactory,
        private TransportCostFactory $transportCostFactory,
    ) {
    }

    public function addPackages(PackageDataCollection $packages): PackageCollection
    {
        $response = $this->client->call(Version::V2V1, $packages->getCarrier(), Method::ADD, ['packages' => $packages->__toArray()]);

        return $this->packageFactory->createCollection($packages->getCarrier(), $packages->__toArray(), $response);
    }

    public function dropPackages(PackageCollection $packages): void
    {
        $this->dropPackagesByPackageIds($packages->getCarrier(), $packages->getPackageIds());
    }

    public function dropPackage(Package $package): void
    {
        $this->dropPackageByPackageId($package->getCarrier(), $package->getPackageId());
    }

    public function dropPackageByPackageId(string $carrier, string $packageId): void
    {
        $this->dropPackagesByPackageIds($carrier, [$packageId]);
    }

    /** @inheritDoc */
    public function dropPackagesByPackageIds(string $carrier, array $packageIds): void
    {
        if (count($packageIds) > 0) {
            $this->client->call(Version::V2V1, $carrier, Method::DROP, ['package_ids' => $packageIds]);
        }
    }

    public function orderShipment(PackageCollection $packages): OrderedShipment
    {
        return $this->orderShipmentByPackageIds($packages->getCarrier(), $packages->getPackageIds());
    }

    /** @inheritDoc */
    public function orderShipmentByPackageIds(string $carrier, array $packageIds): OrderedShipment
    {
        $response = $this->client->call(Version::V2V1, $carrier, Method::ORDER, ['package_ids' => $packageIds]);

        return $this->orderedShipmentFactory->create($carrier, $packageIds, $response);
    }

    public function getOrder(string $carrier, string $orderId): OrderedShipment
    {
        $response = $this->client->call(Version::V2V1, $carrier, Method::ORDER_VIEW, path: $orderId, shouldHaveStatus: false);

        return $this->orderedShipmentFactory->create($carrier, $response['package_ids'], $response);
    }

    public function getOverview(string $carrier): PackageCollection
    {
        $response = $this->client->call(Version::V2V1, $carrier, Method::OVERVIEW, shouldHaveStatus: false);

        return $this->packageFactory->createCollection($carrier, null, $response);
    }

    public function getLabels(PackageCollection $packages): string
    {
        return $this->getLabelsByPackageIds($packages->getCarrier(), $packages->getPackageIds());
    }

    /** @inheritDoc */
    public function getLabelsByPackageIds(string $carrier, array $packageIds): string
    {
        $response = $this->client->call(Version::V2V1, $carrier, Method::LABELS, ['package_ids' => $packageIds]);

        return $this->labelFactory->create($response);
    }

    public function getPackageInfo(Package $package): PackageData
    {
        $packageData = $this->getPackageInfoByCarrierId($package->getCarrier(), $package->getCarrierId());

        $packageData->setEID($package->getBatchId());

        return $packageData;
    }

    public function getPackageInfoByPackageId(string $carrier, string $packageId): PackageData
    {
        $response = $this->client->call(Version::V2V1, $carrier, Method::PACKAGE, path: $packageId, shouldHaveStatus: false);

        return $this->packageDataFactory->create($response);
    }

    public function getPackageInfoByCarrierId(string $carrier, string $carrierId): PackageData
    {
        $response = $this->client->call(
            Version::V2V1,
            $carrier,
            Method::PACKAGE,
            path: sprintf('carrier_id/%s', $carrierId),
            shouldHaveStatus: false,
        );

        return $this->packageDataFactory->create($response);
    }

    public function checkPackages(PackageDataCollection $packages): void
    {
        $this->client->call(Version::V2V1, $packages->getCarrier(), Method::CHECK, ['packages' => $packages->__toArray()]);
    }

    public function getProofOfDelivery(Package $package): string
    {
        return $this->getProofOfDeliveryByCarrierId($package->getCarrier(), $package->getCarrierId());
    }

    /** @inheritDoc */
    public function getProofOfDeliveries(PackageCollection $packages): array
    {
        return $this->getProofOfDeliveriesByCarrierIds($packages->getCarrier(), $packages->getCarrierIds());
    }

    public function getProofOfDeliveryByCarrierId(string $carrier, string $carrierId): string
    {
        return $this->getProofOfDeliveriesByCarrierIds($carrier, [$carrierId])[0];
    }

    /** @inheritDoc */
    public function getProofOfDeliveriesByCarrierIds(string $carrier, array $carrierIds): array
    {
        $response = $this->client->call(
            Version::V1V1,
            $carrier,
            Method::PROOF_OF_DELIVERY,
            array_map(static fn(string $carrierId): array => ['id' => $carrierId], $carrierIds),
            shouldHaveStatus: false,
        );

        return $this->proofOfDeliveryFactory->create($carrierIds, $response);
    }

    public function getTransportCosts(PackageDataCollection $packages): TransportCostCollection
    {
        $response = $this->client->call(Version::V2V1, $packages->getCarrier(), Method::TRANSPORT_COSTS, ['packages' => $packages->__toArray()]);

        return $this->transportCostFactory->createCollection($packages->getCarrier(), $packages->__toArray(), $response);
    }

    public function orderB2AShipment(PackageDataCollection $packages): PackageCollection
    {
        $response = $this->client->call(Version::V2V1, $packages->getCarrier(), Method::B2A, ['packages' => $packages->__toArray()]);

        return $this->packageFactory->createCollection($packages->getCarrier(), $packages->__toArray(), $response);
    }

    public function orderPickup(
        string $carrier,
        DateTimeInterface $dateFrom,
        DateTimeInterface $dateTo,
        float $weight,
        int $packageCount,
        ?string $message = null,
    ): void {
        $response = $this->client->call(Version::V2V1, $carrier, Method::ORDER_PICKUP, [
            'date'          => $dateFrom->format('Y-m-d'),
            'time_from'     => $dateFrom->format('H:s'),
            'time_to'       => $dateTo->format('H:s'),
            'weight'        => $weight,
            'package_count' => $packageCount,
            'message'       => $message,
        ]);

        if (array_key_exists('message', $response)) {
            throw new BadRequestException($response, 400, null, $response['message']);
        }
    }

    public function orderB2CShipment(PackageDataCollection $packages): PackageCollection
    {
        $response = $this->client->call(Version::V2V1, $packages->getCarrier(), Method::B2C, ['packages' => $packages->__toArray()]);

        return $this->packageFactory->createCollection($packages->getCarrier(), $packages->__toArray(), $response);
    }

    public function checkB2APackages(PackageDataCollection $packages): void
    {
        $this->client->call(Version::V2V1, $packages->getCarrier(), Method::B2A_CHECK, ['packages' => $packages->__toArray()]);
    }

    public function checkB2CPackages(PackageDataCollection $packages): void
    {
        $this->client->call(Version::V2V1, $packages->getCarrier(), Method::B2C_CHECK, ['packages' => $packages->__toArray()]);
    }
}
