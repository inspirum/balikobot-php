<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Service\Registry;

use Inspirum\Balikobot\Service\BranchService;
use Inspirum\Balikobot\Service\InfoService;
use Inspirum\Balikobot\Service\PackageService;
use Inspirum\Balikobot\Service\Registry\DefaultServiceContainer;
use Inspirum\Balikobot\Service\SettingService;
use Inspirum\Balikobot\Service\TrackService;
use Inspirum\Balikobot\Tests\Unit\BaseTestCase;

final class DefaultServiceContainerTest extends BaseTestCase
{
    public function testGetter(): void
    {
        $branchService  = $this->createMock(BranchService::class);
        $infoService    = $this->createMock(InfoService::class);
        $packageService = $this->createMock(PackageService::class);
        $settingService = $this->createMock(SettingService::class);
        $trackService   = $this->createMock(TrackService::class);

        $container = new DefaultServiceContainer(
            $branchService,
            $infoService,
            $packageService,
            $settingService,
            $trackService,
        );

        self::assertSame($branchService, $container->getBranchService());
        self::assertSame($infoService, $container->getInfoService());
        self::assertSame($packageService, $container->getPackageService());
        self::assertSame($settingService, $container->getSettingService());
        self::assertSame($trackService, $container->getTrackService());
    }
}
