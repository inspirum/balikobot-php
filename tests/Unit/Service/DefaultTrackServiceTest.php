<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Service;

use Inspirum\Balikobot\Client\Client;
use Inspirum\Balikobot\Definitions\RequestType;
use Inspirum\Balikobot\Definitions\VersionType;
use Inspirum\Balikobot\Model\Package\Package;
use Inspirum\Balikobot\Model\Package\PackageCollection;
use Inspirum\Balikobot\Model\Status\Status;
use Inspirum\Balikobot\Model\Status\StatusCollection;
use Inspirum\Balikobot\Model\Status\StatusFactory;
use Inspirum\Balikobot\Model\Status\Statuses;
use Inspirum\Balikobot\Model\Status\StatusesCollection;
use Inspirum\Balikobot\Service\DefaultTrackService;
use function array_map;

final class DefaultTrackServiceTest extends BaseServiceTest
{
    public function testTrackPackages(): void
    {
        $carrier        = 'cp';
        $carrierIds     = ['1', '2'];
        $response       = $this->mockClientResponse();
        $expectedResult = $this->createMock(StatusesCollection::class);

        $service = $this->newDefaultTrackService(
            client: $this->mockClient([VersionType::V2V2, $carrier, RequestType::TRACK, ['carrier_ids' => $carrierIds], null, false], $response),
            statusFactory: $this->mockStatusFactory($carrier, $carrierIds, $response, $expectedResult),
        );

        $actualResult = $service->trackPackagesByIds($carrier, $carrierIds);

        self::assertSame($expectedResult, $actualResult);

        $service = $this->newDefaultTrackService(
            client: $this->mockClient([VersionType::V2V2, $carrier, RequestType::TRACK, ['carrier_ids' => $carrierIds], null, false], $response),
            statusFactory: $this->mockStatusFactory($carrier, $carrierIds, $response, $expectedResult),
        );

        $actualResult = $service->trackPackages(new PackageCollection($carrier, array_map(static fn(string $carrierId): Package => new Package(
            $carrier,
            '1',
            '1',
            $carrierId,
        ), $carrierIds)));

        self::assertSame($expectedResult, $actualResult);
    }

    public function testTrackPackage(): void
    {
        $carrier                  = 'cp';
        $carrierId                = '3';
        $response                 = $this->mockClientResponse();
        $expectedResult           = $this->createMock(Statuses::class);
        $expectedResultCollection = $this->createMock(StatusesCollection::class);
        $expectedResultCollection->expects(self::exactly(2))->method('getForCarrierId')->with($carrierId)->willReturn($expectedResult);

        $service = $this->newDefaultTrackService(
            client: $this->mockClient([VersionType::V2V2, $carrier, RequestType::TRACK, ['carrier_ids' => [$carrierId]], null, false], $response),
            statusFactory: $this->mockStatusFactory($carrier, [$carrierId], $response, $expectedResultCollection),
        );

        $actualResult = $service->trackPackageById($carrier, $carrierId);

        self::assertSame($expectedResult, $actualResult);

        $service = $this->newDefaultTrackService(
            client: $this->mockClient([VersionType::V2V2, $carrier, RequestType::TRACK, ['carrier_ids' => [$carrierId]], null, false], $response),
            statusFactory: $this->mockStatusFactory($carrier, [$carrierId], $response, $expectedResultCollection),
        );

        $actualResult = $service->trackPackage(new Package(
            $carrier,
            '1',
            '1',
            $carrierId,
        ));

        self::assertSame($expectedResult, $actualResult);
    }

    public function testTrackPackagesLastStatuses(): void
    {
        $carrier        = 'cp';
        $carrierIds     = ['1', '2'];
        $response       = $this->mockClientResponse();
        $expectedResult = $this->createMock(StatusCollection::class);

        $service = $this->newDefaultTrackService(
            client: $this->mockClient([VersionType::V2V2, $carrier, RequestType::TRACK_STATUS, ['carrier_ids' => $carrierIds], null, false], $response),
            statusFactory: $this->mockStatusFactory($carrier, $carrierIds, $response, $expectedResult),
        );

        $actualResult = $service->trackPackagesLastStatusesByIds($carrier, $carrierIds);

        self::assertSame($expectedResult, $actualResult);

        $service = $this->newDefaultTrackService(
            client: $this->mockClient([VersionType::V2V2, $carrier, RequestType::TRACK_STATUS, ['carrier_ids' => $carrierIds], null, false], $response),
            statusFactory: $this->mockStatusFactory($carrier, $carrierIds, $response, $expectedResult),
        );

        $actualResult = $service->trackPackagesLastStatuses(new PackageCollection($carrier, array_map(static fn(string $carrierId): Package => new Package(
            $carrier,
            '1',
            '1',
            $carrierId,
        ), $carrierIds)));

        self::assertSame($expectedResult, $actualResult);
    }

    public function testTrackPackageLastStatus(): void
    {
        $carrier                  = 'cp';
        $carrierId                = '2';
        $response                 = $this->mockClientResponse();
        $expectedResult           = $this->createMock(Status::class);
        $expectedResultCollection = $this->createMock(StatusCollection::class);
        $expectedResultCollection->expects(self::exactly(2))->method('getForCarrierId')->with($carrierId)->willReturn($expectedResult);

        $service = $this->newDefaultTrackService(
            client: $this->mockClient([VersionType::V2V2, $carrier, RequestType::TRACK_STATUS, ['carrier_ids' => [$carrierId]], null, false], $response),
            statusFactory: $this->mockStatusFactory($carrier, [$carrierId], $response, $expectedResultCollection),
        );

        $actualResult = $service->trackPackageLastStatusById($carrier, $carrierId);

        self::assertSame($expectedResult, $actualResult);

        $service = $this->newDefaultTrackService(
            client: $this->mockClient([VersionType::V2V2, $carrier, RequestType::TRACK_STATUS, ['carrier_ids' => [$carrierId]], null, false], $response),
            statusFactory: $this->mockStatusFactory($carrier, [$carrierId], $response, $expectedResultCollection),
        );

        $actualResult = $service->trackPackageLastStatus(new Package(
            $carrier,
            '1',
            '1',
            $carrierId,
        ));

        self::assertSame($expectedResult, $actualResult);
    }

    /**
     * @param array<string>       $carrierIds
     * @param array<string,mixed> $data
     */
    private function mockStatusFactory(string $carrier, array $carrierIds, array $data, StatusesCollection|StatusCollection $response): StatusFactory
    {
        $statusFactory = $this->createMock(StatusFactory::class);
        $statusFactory->expects(self::once())
                       ->method($response instanceof StatusCollection ? 'createLastStatusCollection' : 'createCollection')
                       ->with($carrier, $carrierIds, $data)
                       ->willReturn($response);

        return $statusFactory;
    }

    private function newDefaultTrackService(
        Client $client,
        ?StatusFactory $statusFactory = null,
    ): DefaultTrackService {
        return new DefaultTrackService(
            $client,
            $statusFactory ?? $this->createMock(StatusFactory::class),
        );
    }
}
