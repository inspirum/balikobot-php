<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Balikobot;

use Inspirum\Balikobot\Model\Aggregates\OrderedPackageCollection;
use Inspirum\Balikobot\Model\Values\OrderedPackage;
use Inspirum\Balikobot\Services\Balikobot;

class GetProofOfDeliveriesMethodTest extends AbstractBalikobotTestCase
{
    public function testMakeRequest(): void
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            0 => [
                'status'   => 200,
                'file_url' => 'https://pod.balikobot.cz/tnt/eNorMTY11DUEXDAFrwFs',
            ],
        ]);

        $service = new Balikobot($requester);

        $package = new OrderedPackage('1', 'ppl', '0001', '1236');

        $service->getProofOfDelivery($package);

        $requester->shouldHaveReceived(
            'request',
            [
                'https://apiv2.balikobot.cz/ppl/pod',
                [
                    0 => [
                        'id' => '1236',
                    ],
                ],
            ]
        );

        $this->assertTrue(true);
    }

    public function testResponseDataW(): void
    {
        $service = $this->newMockedBalikobot(200, [
            'status' => 200,
            0        => [
                'status'   => 200,
                'file_url' => 'https://pod.balikobot.cz/tnt/eNorMTY11DUEXDAFrwFs',
            ],
        ]);

        $package = new OrderedPackage('1', 'ppl', '0001', '1236');

        $link = $service->getProofOfDelivery($package);

        $this->assertEquals('https://pod.balikobot.cz/tnt/eNorMTY11DUEXDAFrwFs', $link);
    }

    public function testMakeRequestWithMultiplePackages(): void
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
        $packages->add(new OrderedPackage('1', 'ppl', '0001', '1236'));
        $packages->add(new OrderedPackage('2', 'ppl', '0001', '1234'));

        $service->getProofOfDeliveries($packages);

        $requester->shouldHaveReceived(
            'request',
            [
                'https://apiv2.balikobot.cz/ppl/pod',
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

    public function testResponseDataWithMultiplePackages(): void
    {
        $service = $this->newMockedBalikobot(200, [
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

        $packages = new OrderedPackageCollection();
        $packages->add(new OrderedPackage('1', 'ppl', '0001', '1236'));
        $packages->add(new OrderedPackage('2', 'ppl', '0001', '1234'));

        $links = $service->getProofOfDeliveries($packages);

        $this->assertCount(2, $links);
        $this->assertEquals('https://pod.balikobot.cz/tnt/eNorMTY11DUEXDAFrwFs', $links[0]);
        $this->assertEquals('https://pod.balikobot.cz/tnt/eNorMTY11DUEXDAFrwFa', $links[1]);
    }
}
