<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Integration\Service;

use Inspirum\Balikobot\Tests\Integration\BaseTestCase;

final class DefaultInfoServiceTest extends BaseTestCase
{
    public function testGetAccountInfo(): void
    {
        $infoService = $this->newDefaultInfoService();

        $info = $infoService->getAccountInfo();

        self::assertFalse($info->isLive());
    }

    public function testGetChangelog(): void
    {
        $infoService = $this->newDefaultInfoService();

        $changelog = $infoService->getChangelog();

        self::assertNotEmpty($changelog->getLatestVersion());
    }
}
