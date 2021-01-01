<?php

namespace Inspirum\Balikobot\Tests\Integration\Balikobot;

use Inspirum\Balikobot\Model\Aggregates\OrderedPackageCollection;
use Inspirum\Balikobot\Model\Values\OrderedPackage;

class TrackLastPackagesTest extends AbstractBalikobotTestCase
{
    public function testValidRequest()
    {
        $service = $this->newBalikobot();

        $packages = new OrderedPackageCollection();
        $packages->add(new OrderedPackage(1, 'ppl', '0001', '1236'));
        $packages->add(new OrderedPackage(2, 'ppl', '0001', '1234'));

        $statuses = $service->trackPackagesLastStatus($packages);

        $this->assertCount(2, $statuses);
        $this->assertGreaterThan(1.0, $statuses[0]->getId());
        $this->assertGreaterThan(1.0, $statuses[1]->getId());
    }
}
