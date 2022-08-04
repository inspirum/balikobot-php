<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Integration;

use Inspirum\Balikobot\Client\DefaultClient;
use Inspirum\Balikobot\Client\DefaultCurlRequester;
use Inspirum\Balikobot\Client\Requester;
use Inspirum\Balikobot\Client\Response\Validator;
use Inspirum\Balikobot\Model\Account\DefaultAccountFactory;
use Inspirum\Balikobot\Model\AdrUnit\DefaultAdrUnitFactory;
use Inspirum\Balikobot\Model\Attribute\DefaultAttributeFactory;
use Inspirum\Balikobot\Model\Branch\BranchResolver;
use Inspirum\Balikobot\Model\Branch\DefaultBranchFactory;
use Inspirum\Balikobot\Model\Branch\DefaultBranchResolver;
use Inspirum\Balikobot\Model\Carrier\DefaultCarrierFactory;
use Inspirum\Balikobot\Model\Changelog\DefaultChangelogFactory;
use Inspirum\Balikobot\Model\Country\DefaultCountryFactory;
use Inspirum\Balikobot\Model\Label\DefaultLabelFactory;
use Inspirum\Balikobot\Model\ManipulationUnit\DefaultManipulationUnitFactory;
use Inspirum\Balikobot\Model\Method\DefaultMethodFactory;
use Inspirum\Balikobot\Model\OrderedShipment\DefaultOrderedShipmentFactory;
use Inspirum\Balikobot\Model\Package\DefaultPackageFactory;
use Inspirum\Balikobot\Model\PackageData\DefaultPackageDataFactory;
use Inspirum\Balikobot\Model\ProofOfDelivery\DefaultProofOfDeliveryFactory;
use Inspirum\Balikobot\Model\Service\DefaultServiceFactory;
use Inspirum\Balikobot\Model\Status\DefaultStatusFactory;
use Inspirum\Balikobot\Model\TransportCost\DefaultTransportCostFactory;
use Inspirum\Balikobot\Model\ZipCode\DefaultZipCodeFactory;
use Inspirum\Balikobot\Provider\DefaultCarrierProvider;
use Inspirum\Balikobot\Provider\DefaultServiceProvider;
use Inspirum\Balikobot\Service\DefaultBranchService;
use Inspirum\Balikobot\Service\DefaultInfoService;
use Inspirum\Balikobot\Service\DefaultPackageService;
use Inspirum\Balikobot\Service\DefaultSettingService;
use Inspirum\Balikobot\Service\DefaultTrackService;
use PHPUnit\Framework\TestCase;
use function getenv;

abstract class BaseTestCase extends TestCase
{
    /**
     * @return \Inspirum\Balikobot\Client\Requester
     */
    protected function newDefaultCurlRequester(bool $sslVerify = true): Requester
    {
        $apiUser = (string) getenv('BALIKOBOT_API_USER');
        $apiKey  = (string) getenv('BALIKOBOT_API_KEY');

        return new DefaultCurlRequester($apiUser, $apiKey, $sslVerify);
    }

    protected function newDefaultBranchService(?BranchResolver $branchResolver = null): DefaultBranchService
    {
        return new DefaultBranchService(
            $this->newDefaultClient(),
            new DefaultBranchFactory(),
            $branchResolver ?? new DefaultBranchResolver(),
            new DefaultCarrierProvider(),
            new DefaultServiceProvider(),
        );
    }

    protected function newDefaultInfoService(): DefaultInfoService
    {
        $carrierFactory = new DefaultCarrierFactory(new DefaultMethodFactory());

        return new DefaultInfoService(
            $this->newDefaultClient(),
            new DefaultAccountFactory($carrierFactory),
            $carrierFactory,
            new DefaultChangelogFactory(),
        );
    }

    protected function newDefaultPackageService(): DefaultPackageService
    {
        return new DefaultPackageService(
            $this->newDefaultClient(),
            new DefaultPackageDataFactory(),
            new DefaultPackageFactory($this->newValidator()),
            new DefaultOrderedShipmentFactory(),
            new DefaultLabelFactory(),
            new DefaultProofOfDeliveryFactory($this->newValidator()),
            new DefaultTransportCostFactory($this->newValidator()),
        );
    }

    protected function newDefaultSettingService(): DefaultSettingService
    {
        $countryFactory = new DefaultCountryFactory();

        return new DefaultSettingService(
            $this->newDefaultClient(),
            new DefaultServiceFactory($countryFactory),
            new DefaultManipulationUnitFactory(),
            $countryFactory,
            new DefaultZipCodeFactory(),
            new DefaultAdrUnitFactory(),
            new DefaultAttributeFactory(),
        );
    }

    protected function newDefaultTrackService(): DefaultTrackService
    {
        return new DefaultTrackService(
            $this->newDefaultClient(),
            new DefaultStatusFactory($this->newValidator()),
        );
    }

    private function newDefaultClient(): DefaultClient
    {
        return new DefaultClient($this->newDefaultCurlRequester(), $this->newValidator());
    }

    private function newValidator(): Validator
    {
        return new Validator();
    }
}
