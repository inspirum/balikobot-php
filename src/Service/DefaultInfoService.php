<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Service;

use Inspirum\Balikobot\Client\Client;
use Inspirum\Balikobot\Definitions\Method;
use Inspirum\Balikobot\Definitions\Version;
use Inspirum\Balikobot\Model\Account\Account;
use Inspirum\Balikobot\Model\Account\AccountFactory;
use Inspirum\Balikobot\Model\Changelog\ChangelogCollection;
use Inspirum\Balikobot\Model\Changelog\ChangelogFactory;

final class DefaultInfoService implements InfoService
{
    public function __construct(
        private Client $client,
        private AccountFactory $accountFactory,
        private ChangelogFactory $changelogFactory,
    ) {
    }

    public function getAccountInfo(): Account
    {
        $response = $this->client->call(Version::V2V1, null, Method::INFO_WHO_AM_I);

        return $this->accountFactory->create($response);
    }

    public function getChangelog(): ChangelogCollection
    {
        $response = $this->client->call(Version::V2V1, null, Method::CHANGELOG);

        return $this->changelogFactory->createCollection($response);
    }
}
