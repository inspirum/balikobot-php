<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Service;

use Inspirum\Balikobot\Client\Client;
use Inspirum\Balikobot\Definitions\Method;
use Inspirum\Balikobot\Definitions\Version;
use Inspirum\Balikobot\Model\Account\Account;
use Inspirum\Balikobot\Model\Account\AccountFactory;
use Inspirum\Balikobot\Model\Changelog\ChangelogCollection;
use Inspirum\Balikobot\Model\Changelog\ChangelogFactory;
use Inspirum\Balikobot\Service\DefaultInfoService;

final class DefaultInfoServiceTest extends BaseServiceTestCase
{
    public function testGetAccountInfo(): void
    {
        $response       = $this->mockClientResponse();
        $expectedResult = $this->createMock(Account::class);

        $infoService = $this->newDefaultInfoService(
            client: $this->mockClient([Version::V2V1, null, Method::INFO_WHO_AM_I], $response),
            accountFactory: $this->mockAccountFactory($response, $expectedResult),
        );

        $actualResult = $infoService->getAccountInfo();

        self::assertSame($expectedResult, $actualResult);
    }

    public function testGetChangelog(): void
    {
        $response       = $this->mockClientResponse();
        $expectedResult = $this->createMock(ChangelogCollection::class);

        $infoService = $this->newDefaultInfoService(
            client: $this->mockClient([Version::V2V1, null, Method::CHANGELOG], $response),
            changelogFactory: $this->mockChangelogFactory($response, $expectedResult),
        );

        $actualResult = $infoService->getChangelog();

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
    private function mockChangelogFactory(array $data, ChangelogCollection $response): ChangelogFactory
    {
        $changelogFactory = $this->createMock(ChangelogFactory::class);
        $changelogFactory->expects(self::once())->method('createCollection')->with($data)->willReturn($response);

        return $changelogFactory;
    }

    private function newDefaultInfoService(
        Client $client,
        ?AccountFactory $accountFactory = null,
        ?ChangelogFactory $changelogFactory = null,
    ): DefaultInfoService {
        return new DefaultInfoService(
            $client,
            $accountFactory ?? $this->createMock(AccountFactory::class),
            $changelogFactory ?? $this->createMock(ChangelogFactory::class),
        );
    }
}
