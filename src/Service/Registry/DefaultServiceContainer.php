<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Service\Registry;

use Inspirum\Balikobot\Service\BranchService;
use Inspirum\Balikobot\Service\InfoService;
use Inspirum\Balikobot\Service\PackageService;
use Inspirum\Balikobot\Service\SettingService;
use Inspirum\Balikobot\Service\TrackService;

final class DefaultServiceContainer implements ServiceContainer
{
    public function __construct(
        private readonly BranchService $branchService,
        private readonly InfoService $infoService,
        private readonly PackageService $packageService,
        private readonly SettingService $settingService,
        private readonly TrackService $trackService,
    ) {
    }

    public function getBranchService(): BranchService
    {
        return $this->branchService;
    }

    public function getInfoService(): InfoService
    {
        return $this->infoService;
    }

    public function getPackageService(): PackageService
    {
        return $this->packageService;
    }

    public function getSettingService(): SettingService
    {
        return $this->settingService;
    }

    public function getTrackService(): TrackService
    {
        return $this->trackService;
    }
}
