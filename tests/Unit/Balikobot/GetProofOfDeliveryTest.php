<?php

namespace Inspirum\Balikobot\Tests\Unit\Balikobot;

use Inspirum\Balikobot\Model\Aggregates\OrderedPackageCollection;
use Inspirum\Balikobot\Model\Values\OrderedPackage;
use Inspirum\Balikobot\Services\Balikobot;

class GetProofOfDeliveryTest extends AbstractBalikobotTestCase
{
    public function testMakeRequest()
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            0 => [
                'status'   => 200,
                'file_url' => 'https://pod.balikobot.cz/tnt/eNorMTY11DUEXDAFrwFs',
            ],
        ]);

        $service = new Balikobot($requester);

        $package = new OrderedPackage(1, 'ppl', '0001', '1236');

        $service->getProofOfDelivery($package);

        $requester->shouldHaveReceived(
            'request',
            [
                'https://api.balikobot.cz/ppl/pod',
                [
                    0 => [
                        'id' => '1236',
                    ],
                ],
            ]
        );

        $this->assertTrue(true);
    }

    public function testResponseDataW()
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status' => 200,
            0        => [
                'status'   => 200,
                'file_url' => 'https://pod.balikobot.cz/tnt/eNorMTY11DUEXDAFrwFs',
            ],
        ]);

        $service = new Balikobot($requester);

        $package = new OrderedPackage(1, 'ppl', '0001', '1236');

        $link = $service->getProofOfDelivery($package);

        $this->assertEquals('https://pod.balikobot.cz/tnt/eNorMTY11DUEXDAFrwFs', $link);
    }

    public function testMakeRequestWithMultiplePackages()
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            0 => [
                'status'   => 200,
                'file_url' => 'https://pod.balikobot.cz/tnt/eNorMTY11DUEXDAFrwFs',
            ],
            1 => [
                'status'   => 200,
                'file_url' => 'https://pod.balikobot.cz/tnt/eNorMTY11DUEXDAFrwFs',
            ],
        ]);

        $service = new Balikobot($requester);

        $packages = new OrderedPackageCollection();
        $packages->add(new OrderedPackage(1, 'ppl', '0001', '1236'));
        $packages->add(new OrderedPackage(2, 'ppl', '0001', '1234'));

        $service->getProofOfDeliveries($packages);

        $requester->shouldHaveReceived(
            'request',
            [
                'https://api.balikobot.cz/ppl/pod',
                [
                    0 => [
                        'id' => '1236',
                    ],
                    1 => [
                        'id' => '1234',
                    ],
                ],
            ]
        );

        $this->assertTrue(true);
    }

    public function testResponseDataWithMultiplePackages()
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status' => 200,
            0        => [
                'status'   => 200,
                'file_url' => 'https://pod.balikobot.cz/tnt/eNorMTY11DUEXDAFrwFs',
            ],
            1        => [
                'status'   => 200,
                'file_url' => 'https://pod.balikobot.cz/tnt/eNorMTY11DUEXDAFrwFa',
            ],
        ]);

        $service = new Balikobot($requester);

        $packages = new OrderedPackageCollection();
        $packages->add(new OrderedPackage(1, 'ppl', '0001', '1236'));
        $packages->add(new OrderedPackage(2, 'ppl', '0001', '1234'));

        $links = $service->getProofOfDeliveries($packages);

        $this->assertCount(2, $links);
        $this->assertEquals('https://pod.balikobot.cz/tnt/eNorMTY11DUEXDAFrwFs', $links[0]);
        $this->assertEquals('https://pod.balikobot.cz/tnt/eNorMTY11DUEXDAFrwFa', $links[1]);
    }
}
