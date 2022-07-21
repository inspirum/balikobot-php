<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Service;

use Inspirum\Balikobot\Client\Client;
use Inspirum\Balikobot\Client\Request\Carrier;
use Inspirum\Balikobot\Definitions\Request;
use Inspirum\Balikobot\Definitions\VersionType;
use Inspirum\Balikobot\Model\Account\Account;
use Inspirum\Balikobot\Model\Account\AccountFactory;
use Inspirum\Balikobot\Model\Carrier\Carrier as CarrierModel;
use Inspirum\Balikobot\Model\Carrier\CarrierCollection;
use Inspirum\Balikobot\Model\Carrier\CarrierFactory;
use Inspirum\Balikobot\Model\Changelog\ChangelogCollection;
use Inspirum\Balikobot\Model\Changelog\ChangelogFactory;

class DefaultInfoService implements InfoService
{
    public function __construct(
        private Client $client,
        private AccountFactory $accountFactory,
        private CarrierFactory $carrierFactory,
        private ChangelogFactory $changelogFactory,
    ) {
    }

    public function getAccountInfo(): Account
    {
        $response = $this->client->call(VersionType::V2V1, null, Request::INFO_WHO_AM_I);

        return $this->accountFactory->create($response);
    }

    public function getCarriers(): CarrierCollection
    {
        $response = $this->client->call(VersionType::V2V1, null, Request::INFO_CARRIERS);

        return $this->carrierFactory->createCollection($response);
    }

    public function getCarrier(Carrier $carrier): CarrierModel
    {
        $response = $this->client->call(VersionType::V2V1, null, Request::INFO_CARRIERS, path: $carrier->getValue());

        return $this->carrierFactory->create($carrier, $response);
    }

    public function getChangelog(): ChangelogCollection
    {
        $response = $this->client->call(VersionType::V2V1, null, Request::CHANGELOG);

        return $this->changelogFactory->createCollection($response);
    }
}
