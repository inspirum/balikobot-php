<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Integration\Service;

use Inspirum\Balikobot\Definitions\Carrier;
use Inspirum\Balikobot\Tests\Integration\BaseTestCase;
use function array_diff;
use function sprintf;

final class DefaultInfoServiceTest extends BaseTestCase
{
    public function testGetAccountInfo(): void
    {
        $infoService = $this->newDefaultInfoService();

        $info = $infoService->getAccountInfo();

        self::assertFalse($info->isLive());
    }

    public function testGetCarriers(): void
    {
        $infoService = $this->newDefaultInfoService();

        $carriers = $infoService->getCarriers();

        self::assertNotEmpty($carriers);

        $unsupportedCarriers = array_diff($carriers->getCarrierCodes(), Carrier::all());

        foreach ($unsupportedCarriers as $unsupportedCarrier) {
            self::addWarning(sprintf('Unsupported carrier "%s"', $unsupportedCarrier));
        }
    }

    public function testGetCarrier(): void
    {
        $infoService = $this->newDefaultInfoService();

        $carrier = $infoService->getCarrier(Carrier::CP);

        self::assertSame($carrier->getCode(), Carrier::CP);
    }

    public function testGetChangelog(): void
    {
        $infoService = $this->newDefaultInfoService();

        $changelog = $infoService->getChangelog();

        self::assertNotEmpty($changelog->getLatestVersion());
    }
}
