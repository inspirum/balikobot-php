<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Service;

use DateTimeImmutable;
use Inspirum\Balikobot\Client\Client;
use Inspirum\Balikobot\Definitions\Carrier;
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
use Inspirum\Balikobot\Service\DefaultPackageService;
use function sprintf;

final class DefaultPackageServiceTest extends BaseServiceTestCase
{
    public function testAddPackages(): void
    {
        $carrier = Carrier::PPL;
        $packages = [
            $this->mockClientResponse(),
            $this->mockClientResponse(),
        ];
        $response = $this->mockClientResponse();
        $expectedResult = $this->createMock(PackageCollection::class);

        $collection = $this->createMock(PackageDataCollection::class);
        $collection->expects(self::any())->method('getCarrier')->willReturn($carrier);
        $collection->expects(self::any())->method('__toArray')->willReturn($packages);

        $packageService = $this->newDefaultPackageService(
            client: $this->mockClient([
                Version::V2V1,
                $carrier,
                Method::ADD,
                [
                    'packages' => $packages,
                ],
            ], $response),
            packageFactory: $this->mockPackageFactory($carrier, $packages, $response, $expectedResult),
        );

        $actualResult = $packageService->addPackages($collection);

        self::assertSame($expectedResult, $actualResult);
    }

    public function testDropPackages(): void
    {
        $carrier = Carrier::PPL;
        $packageIds = [
            '1234',
            '5678',
        ];
        $response = $this->mockClientResponse();

        $collection = $this->createMock(PackageCollection::class);
        $collection->expects(self::any())->method('getCarrier')->willReturn($carrier);
        $collection->expects(self::any())->method('getPackageIds')->willReturn($packageIds);

        $packageService = $this->newDefaultPackageService(
            client: $this->mockClient([
                Version::V2V1,
                $carrier,
                Method::DROP,
                [
                    'package_ids' => $packageIds,
                ],
            ], $response),
        );

        $packageService->dropPackages($collection);
    }

    public function testDropPackage(): void
    {
        $carrier = Carrier::PPL;
        $packageId = '1234';
        $response = $this->mockClientResponse();

        $model = $this->createMock(Package::class);
        $model->expects(self::any())->method('getCarrier')->willReturn($carrier);
        $model->expects(self::any())->method('getPackageId')->willReturn($packageId);

        $packageService = $this->newDefaultPackageService(
            client: $this->mockClient([
                Version::V2V1,
                $carrier,
                Method::DROP,
                [
                    'package_ids' => [$packageId],
                ],
            ], $response),
        );

        $packageService->dropPackage($model);
    }

    public function testDropPackageByPackageId(): void
    {
        $carrier = Carrier::PPL;
        $packageId = '1234';
        $response = $this->mockClientResponse();

        $packageService = $this->newDefaultPackageService(
            client: $this->mockClient([
                Version::V2V1,
                $carrier,
                Method::DROP,
                [
                    'package_ids' => [$packageId],
                ],
            ], $response),
        );

        $packageService->dropPackageByPackageId($carrier, $packageId);
    }

    public function testDropPackagesByPackageIds(): void
    {
        $carrier = Carrier::PPL;
        $packageIds = [
            '1234',
            '5678',
        ];
        $response = $this->mockClientResponse();

        $packageService = $this->newDefaultPackageService(
            client: $this->mockClient([
                Version::V2V1,
                $carrier,
                Method::DROP,
                [
                    'package_ids' => $packageIds,
                ],
            ], $response),
        );

        $packageService->dropPackagesByPackageIds($carrier, $packageIds);
    }

    public function testDropPackagesWithoutPackageIds(): void
    {
        $carrier = Carrier::PPL;
        $packageIds = [];

        $packageService = $this->newDefaultPackageService(
            client: $this->mockClient([], null),
        );

        $packageService->dropPackagesByPackageIds($carrier, $packageIds);
    }

    public function testOrderShipment(): void
    {
        $carrier = Carrier::PPL;
        $packageIds = [
            '1234',
            '5678',
        ];
        $response = $this->mockClientResponse();
        $expectedResult = $this->createMock(OrderedShipment::class);

        $collection = $this->createMock(PackageCollection::class);
        $collection->expects(self::any())->method('getCarrier')->willReturn($carrier);
        $collection->expects(self::any())->method('getPackageIds')->willReturn($packageIds);

        $packageService = $this->newDefaultPackageService(
            client: $this->mockClient([
                Version::V2V1,
                $carrier,
                Method::ORDER,
                [
                    'package_ids' => $packageIds,
                ],
            ], $response),
            orderedShipmentFactory: $this->mockOrderedShipmentFactory($carrier, $packageIds, $response, $expectedResult),
        );

        $actualResult = $packageService->orderShipment($collection);

        self::assertSame($expectedResult, $actualResult);
    }

    public function testOrderShipmentByPackageIds(): void
    {
        $carrier = Carrier::PPL;
        $packageIds = [
            '1234',
            '5678',
        ];
        $response = $this->mockClientResponse();
        $expectedResult = $this->createMock(OrderedShipment::class);

        $packageService = $this->newDefaultPackageService(
            client: $this->mockClient([
                Version::V2V1,
                $carrier,
                Method::ORDER,
                [
                    'package_ids' => $packageIds,
                ],
            ], $response),
            orderedShipmentFactory: $this->mockOrderedShipmentFactory($carrier, $packageIds, $response, $expectedResult),
        );

        $actualResult = $packageService->orderShipmentByPackageIds($carrier, $packageIds);

        self::assertSame($expectedResult, $actualResult);
    }

    public function testGetOrder(): void
    {
        $carrier = Carrier::PPL;
        $orderId = '888';
        $packageIds = [
            '4568',
            '9012',
        ];
        $response = [
            'package_ids' => $packageIds,
        ];
        $expectedResult = $this->createMock(OrderedShipment::class);

        $packageService = $this->newDefaultPackageService(
            client: $this->mockClient([
                Version::V2V1,
                $carrier,
                Method::ORDER_VIEW,
                [],
                $orderId,
                false,
            ], $response),
            orderedShipmentFactory: $this->mockOrderedShipmentFactory($carrier, $packageIds, $response, $expectedResult),
        );

        $actualResult = $packageService->getOrder($carrier, $orderId);

        self::assertSame($expectedResult, $actualResult);
    }

    public function testGetOverview(): void
    {
        $carrier = Carrier::PPL;
        $response = $this->mockClientResponse();
        $expectedResult = $this->createMock(PackageCollection::class);

        $packageService = $this->newDefaultPackageService(
            client: $this->mockClient([
                Version::V2V1,
                $carrier,
                Method::OVERVIEW,
                [],
                null,
                false,
            ], $response),
            packageFactory: $this->mockPackageFactory($carrier, null, $response, $expectedResult),
        );

        $actualResult = $packageService->getOverview($carrier);

        self::assertSame($expectedResult, $actualResult);
    }

    public function testGetLabels(): void
    {
        $carrier = Carrier::PPL;
        $packageIds = [
            '1234',
            '5678',
        ];
        $expectedResult = 'mockedLabelsUrl';
        $response = $this->mockClientResponse();

        $collection = $this->createMock(PackageCollection::class);
        $collection->expects(self::any())->method('getCarrier')->willReturn($carrier);
        $collection->expects(self::any())->method('getPackageIds')->willReturn($packageIds);

        $packageService = $this->newDefaultPackageService(
            client: $this->mockClient([
                Version::V2V1,
                $carrier,
                Method::LABELS,
                [
                    'package_ids' => $packageIds,
                ],
            ], $response),
            labelFactory: $this->mockLabelFactory($response, $expectedResult),
        );

        $actualResult = $packageService->getLabels($collection);

        self::assertSame($expectedResult, $actualResult);
    }

    public function testGetLabelsByPackageIds(): void
    {
        $carrier = Carrier::PPL;
        $packageIds = [
            '1234',
            '5678',
        ];
        $expectedResult = 'mockedLabelsUrl';
        $response = $this->mockClientResponse();

        $packageService = $this->newDefaultPackageService(
            client: $this->mockClient([
                Version::V2V1,
                $carrier,
                Method::LABELS,
                [
                    'package_ids' => $packageIds,
                ],
            ], $response),
            labelFactory: $this->mockLabelFactory($response, $expectedResult),
        );

        $actualResult = $packageService->getLabelsByPackageIds($carrier, $packageIds);

        self::assertSame($expectedResult, $actualResult);
    }

    public function testGetPackageInfo(): void
    {
        $carrier = Carrier::PPL;
        $carrierId = '9876';
        $batchID = '11';
        $response = $this->mockClientResponse();

        $model = $this->createMock(Package::class);
        $model->expects(self::any())->method('getCarrier')->willReturn($carrier);
        $model->expects(self::any())->method('getCarrierId')->willReturn($carrierId);
        $model->expects(self::any())->method('getBatchId')->willReturn($batchID);

        $expectedResult = $this->createMock(PackageData::class);
        $expectedResult->expects(self::once())->method('setEID')->with($batchID);

        $packageService = $this->newDefaultPackageService(
            client: $this->mockClient([
                Version::V2V1,
                $carrier,
                Method::PACKAGE,
                [],
                sprintf('carrier_id/%s', $carrierId),
                false,
            ], $response),
            packageDataFactory: $this->mockPackageDataFactory($response, $expectedResult),
        );

        $actualResult = $packageService->getPackageInfo($model);

        self::assertSame($expectedResult, $actualResult);
    }

    public function testGetPackageInfoByPackageId(): void
    {
        $carrier = Carrier::PPL;
        $packageId = '4561';
        $response = $this->mockClientResponse();

        $expectedResult = $this->createMock(PackageData::class);

        $packageService = $this->newDefaultPackageService(
            client: $this->mockClient([
                Version::V2V1,
                $carrier,
                Method::PACKAGE,
                [],
                $packageId,
                false,
            ], $response),
            packageDataFactory: $this->mockPackageDataFactory($response, $expectedResult),
        );

        $actualResult = $packageService->getPackageInfoByPackageId($carrier, $packageId);

        self::assertSame($expectedResult, $actualResult);
    }

    public function testGetPackageInfoByCarrierId(): void
    {
        $carrier = Carrier::PPL;
        $carrierId = '9876';
        $response = $this->mockClientResponse();

        $expectedResult = $this->createMock(PackageData::class);

        $packageService = $this->newDefaultPackageService(
            client: $this->mockClient([
                Version::V2V1,
                $carrier,
                Method::PACKAGE,
                [],
                sprintf('carrier_id/%s', $carrierId),
                false,
            ], $response),
            packageDataFactory: $this->mockPackageDataFactory($response, $expectedResult),
        );

        $actualResult = $packageService->getPackageInfoByCarrierId($carrier, $carrierId);

        self::assertSame($expectedResult, $actualResult);
    }

    public function testCheckPackages(): void
    {
        $carrier = Carrier::PPL;
        $packages = [
            $this->mockClientResponse(),
            $this->mockClientResponse(),
        ];
        $response = $this->mockClientResponse();

        $collection = $this->createMock(PackageDataCollection::class);
        $collection->expects(self::any())->method('getCarrier')->willReturn($carrier);
        $collection->expects(self::any())->method('__toArray')->willReturn($packages);

        $packageService = $this->newDefaultPackageService(
            client: $this->mockClient([
                Version::V2V1,
                $carrier,
                Method::CHECK,
                [
                    'packages' => $packages,
                ],
            ], $response),
        );

        $packageService->checkPackages($collection);
    }

    public function testGetProofOfDelivery(): void
    {
        $carrier = Carrier::PPL;
        $carrierId = '5678';
        $expectedResult = 'mockedFileUrl';
        $response = $this->mockClientResponse();

        $model = $this->createMock(Package::class);
        $model->expects(self::any())->method('getCarrier')->willReturn($carrier);
        $model->expects(self::any())->method('getCarrierId')->willReturn($carrierId);

        $packageService = $this->newDefaultPackageService(
            client: $this->mockClient([
                Version::V1V1,
                $carrier,
                Method::PROOF_OF_DELIVERY,
                [
                    ['id' => $carrierId],
                ],
                null,
                false,
            ], $response),
            proofOfDeliveryFactory: $this->mockProofOfDeliveryFactory([$carrierId], $response, [$expectedResult]),
        );

        $actualResult = $packageService->getProofOfDelivery($model);

        self::assertSame($expectedResult, $actualResult);
    }

    public function testGetProofOfDeliveries(): void
    {
        $carrier = Carrier::PPL;
        $carrierIds = [
            '1234',
            '5678',
            '8526',
        ];
        $expectedResult = [
            'mockedLabelsUrl1',
            'mockedLabelsUrl2',
            'mockedLabelsUrl3',
        ];
        $response = $this->mockClientResponse();

        $collection = $this->createMock(PackageCollection::class);
        $collection->expects(self::any())->method('getCarrier')->willReturn($carrier);
        $collection->expects(self::any())->method('getCarrierIds')->willReturn($carrierIds);

        $packageService = $this->newDefaultPackageService(
            client: $this->mockClient([
                Version::V1V1,
                $carrier,
                Method::PROOF_OF_DELIVERY,
                [
                    ['id' => $carrierIds[0]],
                    ['id' => $carrierIds[1]],
                    ['id' => $carrierIds[2]],
                ],
                null,
                false,
            ], $response),
            proofOfDeliveryFactory: $this->mockProofOfDeliveryFactory($carrierIds, $response, $expectedResult),
        );

        $actualResult = $packageService->getProofOfDeliveries($collection);

        self::assertSame($expectedResult, $actualResult);
    }

    public function testGetProofOfDeliveryByCarrierId(): void
    {
        $carrier = Carrier::PPL;
        $carrierId = '5678';
        $expectedResult = 'mockedFileUrl';
        $response = $this->mockClientResponse();

        $packageService = $this->newDefaultPackageService(
            client: $this->mockClient([
                Version::V1V1,
                $carrier,
                Method::PROOF_OF_DELIVERY,
                [
                    ['id' => $carrierId],
                ],
                null,
                false,
            ], $response),
            proofOfDeliveryFactory: $this->mockProofOfDeliveryFactory([$carrierId], $response, [$expectedResult]),
        );

        $actualResult = $packageService->getProofOfDeliveryByCarrierId($carrier, $carrierId);

        self::assertSame($expectedResult, $actualResult);
    }

    public function testGetProofOfDeliveriesByCarrierIds(): void
    {
        $carrier = Carrier::PPL;
        $carrierIds = [
            '1234',
            '5678',
            '8526',
        ];
        $expectedResult = [
            'mockedLabelsUrl1',
            'mockedLabelsUrl2',
            'mockedLabelsUrl3',
        ];
        $response = $this->mockClientResponse();

        $packageService = $this->newDefaultPackageService(
            client: $this->mockClient([
                Version::V1V1,
                $carrier,
                Method::PROOF_OF_DELIVERY,
                [
                    ['id' => $carrierIds[0]],
                    ['id' => $carrierIds[1]],
                    ['id' => $carrierIds[2]],
                ],
                null,
                false,
            ], $response),
            proofOfDeliveryFactory: $this->mockProofOfDeliveryFactory($carrierIds, $response, $expectedResult),
        );

        $actualResult = $packageService->getProofOfDeliveriesByCarrierIds($carrier, $carrierIds);

        self::assertSame($expectedResult, $actualResult);
    }

    public function testGetTransportCosts(): void
    {
        $carrier = Carrier::PPL;
        $packages = [
            $this->mockClientResponse(),
            $this->mockClientResponse(),
        ];
        $response = $this->mockClientResponse();
        $expectedResult = $this->createMock(TransportCostCollection::class);

        $collection = $this->createMock(PackageDataCollection::class);
        $collection->expects(self::any())->method('getCarrier')->willReturn($carrier);
        $collection->expects(self::any())->method('__toArray')->willReturn($packages);

        $packageService = $this->newDefaultPackageService(
            client: $this->mockClient([
                Version::V2V1,
                $carrier,
                Method::TRANSPORT_COSTS,
                ['packages' => $packages],
            ], $response),
            transportCostFactory: $this->mockTransportCostFactory($carrier, $packages, $response, $expectedResult),
        );

        $actualResult = $packageService->getTransportCosts($collection);

        self::assertSame($expectedResult, $actualResult);
    }

    public function testOrderB2AShipment(): void
    {
        $carrier = Carrier::PPL;
        $packages = [
            $this->mockClientResponse(),
            $this->mockClientResponse(),
        ];
        $response = $this->mockClientResponse();
        $expectedResult = $this->createMock(PackageCollection::class);

        $collection = $this->createMock(PackageDataCollection::class);
        $collection->expects(self::any())->method('getCarrier')->willReturn($carrier);
        $collection->expects(self::any())->method('__toArray')->willReturn($packages);

        $packageService = $this->newDefaultPackageService(
            client: $this->mockClient([
                Version::V2V1,
                $carrier,
                Method::B2A,
                ['packages' => $packages],
            ], $response),
            packageFactory: $this->mockPackageFactory($carrier, $packages, $response, $expectedResult),
        );

        $actualResult = $packageService->orderB2AShipment($collection);

        self::assertSame($expectedResult, $actualResult);
    }

    public function testOrderPickup(): void
    {
        $carrier = Carrier::PPL;
        $dateFrom = new DateTimeImmutable('2020-08-01 16:10:00');
        $dateTo = new DateTimeImmutable('2020-08-01 19:20:00');
        $weight = 15.6;
        $packageCount = 2;
        $message = 'testMessage';

        $response = $this->mockClientResponse();

        $packageService = $this->newDefaultPackageService(
            client: $this->mockClient([
                Version::V2V1,
                $carrier,
                Method::ORDER_PICKUP,
                [
                    'date' => '2020-08-01',
                    'time_from' => '16:10',
                    'time_to' => '19:20',
                    'weight' => $weight,
                    'package_count' => $packageCount,
                    'message' => $message,
                ],
            ], $response),
        );

        $packageService->orderPickup(
            $carrier,
            $dateFrom,
            $dateTo,
            $weight,
            $packageCount,
            $message,
        );
    }

    public function testOrderPickupWithError(): void
    {
        $errorMessage = 'Tato metoda není u dopravce podporována.';

        $this->expectException(BadRequestException::class);
        $this->expectExceptionMessage($errorMessage);

        $carrier = Carrier::PPL;
        $dateFrom = new DateTimeImmutable('2020-08-01 16:10:00');
        $dateTo = new DateTimeImmutable('2020-08-01 19:20:00');
        $weight = 15.6;
        $packageCount = 2;
        $message = 'testMessage';

        $response = [
            'message' => $errorMessage,
        ];

        $packageService = $this->newDefaultPackageService(
            client: $this->mockClient([
                Version::V2V1,
                $carrier,
                Method::ORDER_PICKUP,
                [
                    'date' => '2020-08-01',
                    'time_from' => '16:10',
                    'time_to' => '19:20',
                    'weight' => $weight,
                    'package_count' => $packageCount,
                    'message' => $message,
                ],
            ], $response),
        );

        $packageService->orderPickup(
            $carrier,
            $dateFrom,
            $dateTo,
            $weight,
            $packageCount,
            $message,
        );
    }

    public function testOrderB2CShipment(): void
    {
        $carrier = Carrier::PPL;
        $packages = [
            $this->mockClientResponse(),
            $this->mockClientResponse(),
        ];
        $response = $this->mockClientResponse();
        $expectedResult = $this->createMock(PackageCollection::class);

        $collection = $this->createMock(PackageDataCollection::class);
        $collection->expects(self::any())->method('getCarrier')->willReturn($carrier);
        $collection->expects(self::any())->method('__toArray')->willReturn($packages);

        $packageService = $this->newDefaultPackageService(
            client: $this->mockClient([
                Version::V2V1,
                $carrier,
                Method::B2C,
                ['packages' => $packages],
            ], $response),
            packageFactory: $this->mockPackageFactory($carrier, $packages, $response, $expectedResult),
        );

        $actualResult = $packageService->orderB2CShipment($collection);

        self::assertSame($expectedResult, $actualResult);
    }

    public function testCheckB2APackages(): void
    {
        $carrier = Carrier::TOPTRANS;
        $packages = [
            $this->mockClientResponse(),
            $this->mockClientResponse(),
        ];
        $response = $this->mockClientResponse();

        $collection = $this->createMock(PackageDataCollection::class);
        $collection->expects(self::any())->method('getCarrier')->willReturn($carrier);
        $collection->expects(self::any())->method('__toArray')->willReturn($packages);

        $packageService = $this->newDefaultPackageService(
            client: $this->mockClient([
                Version::V2V1,
                $carrier,
                Method::B2A_CHECK,
                [
                    'packages' => $packages,
                ],
            ], $response),
        );

        $packageService->checkB2APackages($collection);
    }

    public function testCheckB2CPackages(): void
    {
        $carrier = Carrier::TOPTRANS;
        $packages = [
            $this->mockClientResponse(),
            $this->mockClientResponse(),
        ];
        $response = $this->mockClientResponse();

        $collection = $this->createMock(PackageDataCollection::class);
        $collection->expects(self::any())->method('getCarrier')->willReturn($carrier);
        $collection->expects(self::any())->method('__toArray')->willReturn($packages);

        $packageService = $this->newDefaultPackageService(
            client: $this->mockClient([
                Version::V2V1,
                $carrier,
                Method::B2C_CHECK,
                [
                    'packages' => $packages,
                ],
            ], $response),
        );

        $packageService->checkB2CPackages($collection);
    }

    /**
     * @param array<string,mixed> $data
     */
    private function mockPackageDataFactory(array $data, PackageData $response): PackageDataFactory
    {
        $packageDataFactory = $this->createMock(PackageDataFactory::class);
        $packageDataFactory->expects(self::once())->method('create')->with($data)->willReturn($response);

        return $packageDataFactory;
    }

    /**
     * @param array<int,array<string,mixed>>|null $packages
     * @param array<string,mixed> $data
     */
    private function mockPackageFactory(string $carrier, ?array $packages, array $data, PackageCollection $response): PackageFactory
    {
        $packageFactory = $this->createMock(PackageFactory::class);
        $packageFactory->expects(self::once())->method('createCollection')->with($carrier, $packages, $data)->willReturn($response);

        return $packageFactory;
    }

    /**
     * @param array<string> $packageIds
     * @param array<string,mixed> $data
     */
    private function mockOrderedShipmentFactory(string $carrier, array $packageIds, array $data, OrderedShipment $response): OrderedShipmentFactory
    {
        $orderedShipmentFactory = $this->createMock(OrderedShipmentFactory::class);
        $orderedShipmentFactory->expects(self::once())->method('create')->with($carrier, $packageIds, $data)->willReturn($response);

        return $orderedShipmentFactory;
    }

    /**
     * @param array<string,mixed> $data
     */
    private function mockLabelFactory(array $data, string $response): LabelFactory
    {
        $labelFactory = $this->createMock(LabelFactory::class);
        $labelFactory->expects(self::once())->method('create')->with($data)->willReturn($response);

        return $labelFactory;
    }

    /**
     * @param array<string> $carrierIds
     * @param array<string,mixed> $data
     * @param array<string> $response
     */
    private function mockProofOfDeliveryFactory(array $carrierIds, array $data, array $response): ProofOfDeliveryFactory
    {
        $proofOfDeliveryFactory = $this->createMock(ProofOfDeliveryFactory::class);
        $proofOfDeliveryFactory->expects(self::once())->method('create')->with($carrierIds, $data)->willReturn($response);

        return $proofOfDeliveryFactory;
    }

    /**
     * @param array<int,array<string,mixed>>|null $packages
     * @param array<string,mixed> $data
     */
    private function mockTransportCostFactory(string $carrier, ?array $packages, array $data, TransportCostCollection $response): TransportCostFactory
    {
        $transportCostFactory = $this->createMock(TransportCostFactory::class);
        $transportCostFactory->expects(self::once())->method('createCollection')->with($carrier, $packages, $data)->willReturn($response);

        return $transportCostFactory;
    }

    private function newDefaultPackageService(
        Client $client,
        ?PackageDataFactory $packageDataFactory = null,
        ?PackageFactory $packageFactory = null,
        ?OrderedShipmentFactory $orderedShipmentFactory = null,
        ?LabelFactory $labelFactory = null,
        ?ProofOfDeliveryFactory $proofOfDeliveryFactory = null,
        ?TransportCostFactory $transportCostFactory = null,
    ): DefaultPackageService {
        return new DefaultPackageService(
            $client,
            $packageDataFactory ?? $this->createMock(PackageDataFactory::class),
            $packageFactory ?? $this->createMock(PackageFactory::class),
            $orderedShipmentFactory ?? $this->createMock(OrderedShipmentFactory::class),
            $labelFactory ?? $this->createMock(LabelFactory::class),
            $proofOfDeliveryFactory ?? $this->createMock(ProofOfDeliveryFactory::class),
            $transportCostFactory ?? $this->createMock(TransportCostFactory::class),
        );
    }
}
