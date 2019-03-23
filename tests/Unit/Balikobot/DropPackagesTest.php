<?php

namespace Inspirum\Balikobot\Tests\Unit\Balikobot;

use Inspirum\Balikobot\Model\Aggregates\OrderedPackageCollection;
use Inspirum\Balikobot\Model\Values\OrderedPackage;
use Inspirum\Balikobot\Services\Balikobot;

class DropPackagesTest extends AbstractBalikobotTestCase
{
    public function testMakeRequest()
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status' => 200,
        ]);

        $service = new Balikobot($requester);

        $packages = new OrderedPackageCollection();

        $packages->add(new OrderedPackage(1, 'ppl', '0001', '1234'));
        $packages->add(new OrderedPackage(2, 'ppl', '0001', '5678'));

        $service->dropPackages($packages);

        $requester->shouldHaveReceived(
            'request',
            [
                'https://api.balikobot.cz/ppl/drop',
                [
                    0 => [
                        'id' => 1,
                    ],
                    1 => [
                        'id' => 2,
                    ],
                ],
            ]
        );

        $this->assertTrue(true);
    }

    public function testMakeRequestForSinglePackage()
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status' => 200,
        ]);

        $service = new Balikobot($requester);

        $package = new OrderedPackage(1, 'ppl', '0001', '1234');

        $service->dropPackage($package);

        $requester->shouldHaveReceived(
            'request',
            [
                'https://api.balikobot.cz/ppl/drop',
                [
                    0 => [
                        'id' => 1,
                    ],
                ],
            ]
        );

        $this->assertTrue(true);
    }
}
