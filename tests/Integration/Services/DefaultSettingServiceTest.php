<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Integration\Service;

use Inspirum\Balikobot\Definitions\Carrier;
use Inspirum\Balikobot\Definitions\Service;
use Inspirum\Balikobot\Tests\Integration\BaseTestCase;
use function array_diff;
use function count;
use function sprintf;

final class DefaultSettingServiceTest extends BaseTestCase
{
    public function testGetCarriers(): void
    {
        $settingService = $this->newDefaultSettingService();

        $carriers = $settingService->getCarriers();

        self::assertGreaterThan(0, count($carriers));

        $unsupportedCarriers = array_diff($carriers->getCarrierCodes(), Carrier::getAll());

        foreach ($unsupportedCarriers as $unsupportedCarrier) {
            self::markTestIncomplete(sprintf('Unsupported carrier "%s"', $unsupportedCarrier));
        }
    }

    public function testGetCarrier(): void
    {
        $settingService = $this->newDefaultSettingService();

        $carrier = $settingService->getCarrier(Carrier::CP);

        self::assertSame($carrier->getCode(), Carrier::CP);
    }

    public function testGetServices(): void
    {
        $settingService = $this->newDefaultSettingService();

        $services = $settingService->getServices(Carrier::CP);

        self::assertGreaterThanOrEqual(1, $services->count());
    }

    public function testGetActivatedServices(): void
    {
        $settingService = $this->newDefaultSettingService();

        $services = $settingService->getActivatedServices(Carrier::CP);

        self::assertGreaterThanOrEqual(1, $services->count());
        self::assertNotNull($services->supportsCargo());
        self::assertNotNull($services->supportsParcel());
    }

    public function testGetB2AServices(): void
    {
        $settingService = $this->newDefaultSettingService();

        $services = $settingService->getB2AServices(Carrier::PPL);

        self::assertGreaterThanOrEqual(1, $services->count());
    }

    public function testGetManipulationUnits(): void
    {
        $settingService = $this->newDefaultSettingService();

        $units = $settingService->getManipulationUnits(Carrier::PPL);

        self::assertGreaterThanOrEqual(1, $units->count());
    }

    public function testGetActivatedManipulationUnits(): void
    {
        $settingService = $this->newDefaultSettingService();

        $units = $settingService->getActivatedManipulationUnits(Carrier::PPL);

        self::assertGreaterThanOrEqual(1, $units->count());
    }

    public function testGetCodCountries(): void
    {
        $settingService = $this->newDefaultSettingService();

        $countries = $settingService->getCodCountries(Carrier::CP);

        self::assertGreaterThanOrEqual(1, $countries->count());
        self::assertNotNull($countries[0]?->getCodCountries());
    }

    public function testGetCountries(): void
    {
        $settingService = $this->newDefaultSettingService();

        $countries = $settingService->getCountries(Carrier::CP);

        self::assertGreaterThanOrEqual(1, $countries->count());
        self::assertNotNull($countries[0]?->getCountries());
    }

    public function testGetCountriesData(): void
    {
        $settingService = $this->newDefaultSettingService();

        $countries = $settingService->getCountriesData();

        self::assertGreaterThanOrEqual(1, $countries->count());
    }

    public function testGetZipCodes(): void
    {
        $settingService = $this->newDefaultSettingService();

        $zipCodes = $settingService->getZipCodes(Carrier::CP, Service::CP_NB);

        $zipCodes->next();
        self::assertTrue($zipCodes->valid());
        self::assertNotNull($zipCodes->current());
    }

    public function testGetAdrUnits(): void
    {
        $settingService = $this->newDefaultSettingService();

        $units = $settingService->getAdrUnits(Carrier::TOPTRANS);

        self::assertGreaterThanOrEqual(1, $units->count());
    }

    public function testGetAddAttributes(): void
    {
        $settingService = $this->newDefaultSettingService();

        $attributes = $settingService->getAddAttributes(Carrier::CP);

        self::assertGreaterThanOrEqual(1, $attributes->count());
    }

    public function testGetAddServiceOptions(): void
    {
        $settingService = $this->newDefaultSettingService();

        $services = $settingService->getAddServiceOptions(Carrier::CP);

        self::assertGreaterThanOrEqual(1, $services->count());
        self::assertNotNull($services[0]?->getOptions());
    }

    public function testGetAddServiceOptionsForService(): void
    {
        $settingService = $this->newDefaultSettingService();

        $service = $settingService->getAddServiceOptionsForService(Carrier::CP, Service::CP_NB);

        self::assertNotNull($service->getOptions());
    }
}
