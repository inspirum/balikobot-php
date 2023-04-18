<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Integration\Service;

use Inspirum\Balikobot\Definitions\Carrier;
use Inspirum\Balikobot\Model\Package\DefaultPackage;
use Inspirum\Balikobot\Model\Package\DefaultPackageCollection;
use Inspirum\Balikobot\Tests\Integration\BaseTestCase;

final class DefaultTrackServiceTest extends BaseTestCase
{
    public function testTrackPackages(): void
    {
        $trackService = $this->newDefaultTrackService();

        $packages = new DefaultPackageCollection(Carrier::PPL);
        $packages->add(new DefaultPackage(Carrier::PPL, '1', '0001', '1234'));
        $packages->add(new DefaultPackage(Carrier::PPL, '2', '0001', '1235'));

        $statuses = $trackService->trackPackages($packages);

        self::assertCount(2, $statuses);
    }

    public function testTrackPackagesLastStatuses(): void
    {
        $trackService = $this->newDefaultTrackService();

        $packages = new DefaultPackageCollection(Carrier::DHL);
        $packages->add(new DefaultPackage(Carrier::DHL, '1', '0001', '1234'));
        $packages->add(new DefaultPackage(Carrier::DHL, '2', '0001', '1235'));

        $statuses = $trackService->trackPackagesLastStatuses($packages);

        self::assertCount(2, $statuses);
    }
}
