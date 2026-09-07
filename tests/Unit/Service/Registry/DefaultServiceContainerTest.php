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
        $branchService = self::createStub(BranchService::class);
        $infoService = self::createStub(InfoService::class);
        $packageService = self::createStub(PackageService::class);
        $settingService = self::createStub(SettingService::class);
        $trackService = self::createStub(TrackService::class);

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
