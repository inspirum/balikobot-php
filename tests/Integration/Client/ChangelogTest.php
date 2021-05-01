<?php

namespace Inspirum\Balikobot\Tests\Integration\Client;

class ChangelogTest extends AbstractClientTestCase
{
    public function testLatestChangesSupport()
    {
        $service = $this->newClient();

        $changelog = $service->getChangelog();

        $expected = '1.918';
        $actual   = $changelog['version'];

        if ($actual !== $expected) {
            $this->addWarning(sprintf('Package not supporting latest changes [%s > %s]', $actual, $expected));
        } else {
            $this->assertTrue(true);
        }
    }
}
