<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Integration\Client;

use function sprintf;

class ChangelogTest extends AbstractClientTestCase
{
    public function testLatestChangesSupport(): void
    {
        $service = $this->newClient();

        $changelog = $service->getChangelog();

        $expected = '1.955';
        $actual   = $changelog['version'];

        if ($actual > $expected) {
            $this->addWarning(sprintf('Package not supporting latest changes [%s > %s]', $actual, $expected));
        } else {
            self::assertTrue(true);
        }
    }
}
