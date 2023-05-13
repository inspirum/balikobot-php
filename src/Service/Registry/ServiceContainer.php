<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Service\Registry;

use Inspirum\Balikobot\Service\BranchService;
use Inspirum\Balikobot\Service\InfoService;
use Inspirum\Balikobot\Service\PackageService;
use Inspirum\Balikobot\Service\SettingService;
use Inspirum\Balikobot\Service\TrackService;

interface ServiceContainer
{
    /**
     * Get branch service
     */
    public function getBranchService(): BranchService;

    /**
     * Get info service
     */
    public function getInfoService(): InfoService;

    /**
     * Get package service
     */
    public function getPackageService(): PackageService;

    /**
     * Get setting service
     */
    public function getSettingService(): SettingService;

    /**
     * Get track service
     */
    public function getTrackService(): TrackService;
}
