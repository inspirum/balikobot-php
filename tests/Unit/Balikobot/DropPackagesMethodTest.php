<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Balikobot;

use Inspirum\Balikobot\Model\Aggregates\OrderedPackageCollection;
use Inspirum\Balikobot\Model\Values\OrderedPackage;
use Inspirum\Balikobot\Services\Balikobot;

class DropPackagesMethodTest extends AbstractBalikobotTestCase
{
    public function testMakeRequest(): void
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status' => 200,
        ]);

        $service = new Balikobot($requester);

        $packages = new OrderedPackageCollection();

        $packages->add(new OrderedPackage('1', 'ppl', '0001', '1234'));
        $packages->add(new OrderedPackage('2', 'ppl', '0001', '5678'));

        $service->dropPackages($packages);

        $requester->shouldHaveReceived(
            'request',
            [
                'https://apiv2.balikobot.cz/ppl/drop',
                [
                    'package_ids' => [
                        '1',
                        '2',
                    ],
                ],
            ]
        );

        self::assertTrue(true);
    }

    public function testMakeRequestForSinglePackage(): void
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status' => 200,
        ]);

        $service = new Balikobot($requester);

        $package = new OrderedPackage('1', 'ppl', '0001', '1234');

        $service->dropPackage($package);

        $requester->shouldHaveReceived(
            'request',
            [
                'https://apiv2.balikobot.cz/ppl/drop',
                [
                    'package_ids' => [
                        '1',
                    ],
                ],
            ]
        );

        self::assertTrue(true);
    }
}
