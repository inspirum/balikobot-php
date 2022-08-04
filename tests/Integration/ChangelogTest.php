<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Integration;

use function sprintf;

class ChangelogTest extends BaseTestCase
{
    public function testLatestChangesSupport(): void
    {
        $infoService = $this->newDefaultInfoService();

        $changelog = $infoService->getChangelog();

        $expected = '1.955';
        $actual   = $changelog->getLatestVersion();

        if ($actual > $expected) {
            $this->addWarning(sprintf('Package not supporting latest changes [%s > %s]', $actual, $expected));
        } else {
            self::assertSame($expected, $actual);
        }
    }
}
