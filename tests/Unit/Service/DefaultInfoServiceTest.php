<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Service;

use Inspirum\Balikobot\Client\Client;
use Inspirum\Balikobot\Definitions\RequestType;
use Inspirum\Balikobot\Definitions\VersionType;
use Inspirum\Balikobot\Model\Account\Account;
use Inspirum\Balikobot\Model\Account\AccountFactory;
use Inspirum\Balikobot\Model\Carrier\Carrier;
use Inspirum\Balikobot\Model\Carrier\CarrierCollection;
use Inspirum\Balikobot\Model\Carrier\CarrierFactory;
use Inspirum\Balikobot\Model\Changelog\ChangelogCollection;
use Inspirum\Balikobot\Model\Changelog\ChangelogFactory;
use Inspirum\Balikobot\Service\DefaultInfoService;

final class DefaultInfoServiceTest extends BaseServiceTest
{
    public function testGetAccountInfo(): void
    {
        $response       = $this->mockClientResponse();
        $expectedResult = $this->createMock(Account::class);

        $service = $this->newDefaultInfoService(
            client: $this->mockClient([VersionType::V2V1, null, RequestType::INFO_WHO_AM_I], $response),
            accountFactory: $this->mockAccountFactory($response, $expectedResult),
        );

        $actualResult = $service->getAccountInfo();

        self::assertSame($expectedResult, $actualResult);
    }

    public function testGetCarriers(): void
    {
        $response       = $this->mockClientResponse();
        $expectedResult = $this->createMock(CarrierCollection::class);

        $service = $this->newDefaultInfoService(
            client: $this->mockClient([VersionType::V2V1, null, RequestType::INFO_CARRIERS], $response),
            carrierFactory: $this->mockCarrierFactory(null, $response, $expectedResult),
        );

        $actualResult = $service->getCarriers();

        self::assertSame($expectedResult, $actualResult);
    }

    public function testGetCarrier(): void
    {
        $carrier        = \Inspirum\Balikobot\Definitions\Carrier::ZASILKOVNA;
        $response       = $this->mockClientResponse();
        $expectedResult = $this->createMock(Carrier::class);

        $service = $this->newDefaultInfoService(
            client: $this->mockClient([VersionType::V2V1, null, RequestType::INFO_CARRIERS, [], $carrier], $response),
            carrierFactory: $this->mockCarrierFactory($carrier, $response, $expectedResult),
        );

        $actualResult = $service->getCarrier($carrier);

        self::assertSame($expectedResult, $actualResult);
    }

    public function testGetChangelog(): void
    {
        $response       = $this->mockClientResponse();
        $expectedResult = $this->createMock(ChangelogCollection::class);

        $service = $this->newDefaultInfoService(
            client: $this->mockClient([VersionType::V2V1, null, RequestType::CHANGELOG], $response),
            changelogFactory: $this->mockChangelogFactory($response, $expectedResult),
        );

        $actualResult = $service->getChangelog();

        self::assertSame($expectedResult, $actualResult);
    }

    /**
     * @param array<string,mixed> $data
     */
    private function mockAccountFactory(array $data, Account $response): AccountFactory
    {
        $accountFactory = $this->createMock(AccountFactory::class);
        $accountFactory->expects(self::once())->method('create')->with($data)->willReturn($response);

        return $accountFactory;
    }

    /**
     * @param array<string,mixed> $data
     */
    private function mockCarrierFactory(?string $carrier, array $data, CarrierCollection|Carrier $response): CarrierFactory
    {
        $carrierFactory = $this->createMock(CarrierFactory::class);
        $carrierFactory->expects(self::once())
                       ->method($response instanceof Carrier ? 'create' : 'createCollection')
                       ->with(...($response instanceof Carrier ? [$carrier, $data] : [$data]))
                       ->willReturn($response);

        return $carrierFactory;
    }

    /**
     * @param array<string,mixed> $data
     */
    private function mockChangelogFactory(array $data, ChangelogCollection $response): ChangelogFactory
    {
        $changelogFactory = $this->createMock(ChangelogFactory::class);
        $changelogFactory->expects(self::once())->method('createCollection')->with($data)->willReturn($response);

        return $changelogFactory;
    }

    private function newDefaultInfoService(
        Client $client,
        ?AccountFactory $accountFactory = null,
        ?CarrierFactory $carrierFactory = null,
        ?ChangelogFactory $changelogFactory = null,
    ): DefaultInfoService {
        return new DefaultInfoService(
            $client,
            $accountFactory ?? $this->createMock(AccountFactory::class),
            $carrierFactory ?? $this->createMock(CarrierFactory::class),
            $changelogFactory ?? $this->createMock(ChangelogFactory::class),
        );
    }
}
